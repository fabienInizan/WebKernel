#!/usr/bin/env python

import argparse

class Attribute:
	def __init__(self, string):
		self.mandatory = (string[0] == '+')
		self.name = (string[0] == '+') and string[1:] or string
		
def uncapitalize(string):
	return string[0].lower() + string[1:]

def mkEntity(className, attributes):
	print('<?php\n')
	print('class ' + className + '\n{')
	for attribute in attributes:
		if attribute.mandatory:
			print('	/* ' + attribute.name + ' is mandatory */')
		print('	private $_' + attribute.name + ';')
		
	for attribute in attributes:
		print('')
		print('	public function get' + attribute.name.capitalize() + '()')
		print('	{')
		print('		return $this->_' + attribute.name + ';')
		print('	}')
		
	for attribute in attributes:
		print('')
		print('	public function set' + attribute.name.capitalize() + '($' + attribute.name + ')')
		print('	{')
		print('		$this->_' + attribute.name + ' = $' + attribute.name + ';')
		print('	}')
	
	print('}\n\n?>')

def mkContainer(className, attributes):
	print('<?php\n\nrequire_once(\'model/containers/Container_Pdo.php\');\n')
	print('class ' + className + 'Container extends Container_Pdo');
	print('''{
	private static $_instance;

	public static function getInstance()
	{
		if(empty(self::$_instance))
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function getAll()
	{''')
	print('		$query = \'SELECT * FROM `' + uncapitalize(className) + '`\';')
	print('''
		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
''')
	print('		$' + uncapitalize(className) + 's = array();')
	print('')
	print('		foreach($rows as $row)')
	print('		{')
	print('			$' + uncapitalize(className) + 's[] = $this->createEntity(\'' + className + '\', $row);')
	print('		}')
	print('')
	print('		return $' + uncapitalize(className) + 's;')
	print('	}')
	print('''
	public function getById($id)
	{''')
	print('		$query = \'SELECT * FROM `' + uncapitalize(className) + '` WHERE ' + uncapitalize(className) + '.id = :id\';')
	print('''
		$params = array('id'=>$id);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (empty($row))
		{''')
	print('			throw new Exception(\'Cannot find required ' + uncapitalize(className) + '\');')
	print('		}')
	print('')
	print('		return $this->createEntity(\'' + className + '\', $row);')
	print('	}')
	print('')
	print('	public function save(' + className + ' $' + uncapitalize(className) + ')')
	print('	{')
	print('		$id = $' + uncapitalize(className) + '->getId();')
	print('''		$double = null;

		try
		{
			$double = $this->getById($id);
		}
		catch(Exception $e)
		{
		}

		if(!empty($double))
		{''')
	
	setlist = ''
	# Skip id
	for attribute in attributes[1:]:
		setlist += uncapitalize(className) + '.' + attribute.name + ' = :' + attribute.name + ', '
	setlist = setlist[:-2]
	print('			$query = \'UPDATE `' + uncapitalize(className) + '` SET ' + setlist + ' WHERE ' + uncapitalize(className) + '.id = :id\';')
	
	params = '\'id\'=>$' + uncapitalize(className) + '->getId(), '
	for attribute in attributes[1:]:
		params += '\'' + attribute.name + '\'=>$' + uncapitalize(className) + '->get' + attribute.name.capitalize() + '(), '
	params = params[:-2]
	print('')
	print('			$params = array(' + params + ');')
	print('		}')
	print('		else')
	print('		{')
	
	insertlist = ''
	values = ''
	for attribute in attributes:
		insertlist += attribute.name + ', '
		values += ':' + attribute.name + ', '
	insertlist = insertlist[:-2]
	values = values[:-2]
	print('			$query = \'INSERT INTO `' + uncapitalize(className) + '`(' + insertlist + ') VALUES(' + values + ')\';')
	print('')
	print('			$params = array(' + params + ');')
	print('		}')
	print('''
		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);

		if(empty($id))
		{''')
	print('			$' + uncapitalize(className) + '->setId($this->getPdo()->lastInsertId());')
	print('		}')
	print('	}')
	print('')
	print('	public function delete(' + className + ' $' + uncapitalize(className) + ')')
	print('	{')
	print('		$query = \'DELETE FROM `' + uncapitalize(className) + '` WHERE ' + uncapitalize(className) + '.id = :id\';')
	print('')
	print('		$params = array(\'id\'=>$' + uncapitalize(className) + '->getId());')
	print('''
		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}
}

?>''')
	
	
def mkGet(className, attributes):
	for attribute in attributes:
		if attribute.mandatory:
			print('$' + attribute.name + ' = $httpRequest->' + attribute.name)
		else:
			print('$' + attribute.name + ' = $httpRequest->' + attribute.name + ' or ""')
	
def mkNew(className, attributes):
	print(uncapitalize(className) + ' = new ' + className + '();')
	for attribute in attributes:
		print(uncapitalize(className) + '->set' + attribute.name.capitalize() + '(' + attribute.name + ');')

def mkFilter(className, attributes):
	first = True
	# Do not filter on id
	for attribute in attributes[1:]:
		if attribute.mandatory:
			if first:
				printout = 'if(isset($' + attribute.name + ') && !empty($' + attribute.name + ')	&&'
				first = False
			else:
				printout += '\n	isset($' + attribute.name + ') && !empty($' + attribute.name + ')	&&'
	printout = printout[:-3] + ')'
	print(printout)
	
def main():
	parser = argparse.ArgumentParser(prog='webKernelCLI', description='A toolbox for WebKernel.', epilog='Prefix the attributes with a + to make them mandatory. The id attribute is a mandatory one and will be automatically added')
	parser.add_argument('className', metavar='className', help='The name of the entity')
	parser.add_argument('attributeList', metavar='attribute', nargs='+', help='The attributes of the entity')
	parser.add_argument('-e', '--entity', dest='action', action='store_const', const=mkEntity, default=mkEntity, help='Output the entity (class) file')
	parser.add_argument('-c', '--container', dest='action', action='store_const', const=mkContainer, default=mkEntity, help='Output the container file')
	parser.add_argument('-g', '--get', dest='action', action='store_const', const=mkGet, default=mkEntity, help='Output the $httpRequest GET or POST acquisition lines')
	parser.add_argument('-n', '--new', dest='action', action='store_const', const=mkNew, default=mkEntity, help='Output the class creation (new) lines')
	parser.add_argument('-f', '--filter', dest='action', action='store_const', const=mkFilter, default=mkEntity, help='Output the httpRequest filtering lines')

	args = parser.parse_args()
	
	attributes = [Attribute('+id')]
	for attributeItem in args.attributeList:
		attributes.append(Attribute(attributeItem))
		
	args.action(args.className, attributes)

if __name__ == "__main__":
	main()
