-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2015 at 02:43 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `comment_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`article_id`),
  KEY `fk_articles_users` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `title`, `user_id`, `body`, `created`, `modified`, `comment_count`) VALUES
(46, 'Converting HasMany Data', 10, 'If you are saving hasMany associations and want to link existing records to a new parent record you can use the _ids format:\r\n\r\n$data = [\r\n    ''title'' => ''My new article'',\r\n    ''body'' => ''The text'',\r\n    ''user_id'' => 1,\r\n    ''comments'' => [\r\n        ''_ids'' => [1, 2, 3, 4]\r\n    ]\r\n];\r\nWhen converting hasMany data, you can disable the new entity creation, by using the onlyIds option. When enabled, this option restricts hasMany marshalling to only use the _ids key and ignore all other data.', '2015-11-30 21:00:50', '2015-11-30 21:32:28', 3),
(52, 'Anatomy of a Unit Test', 7, 'When you create a unit test, several files are added to your solution. In this topic, we will use an example of a unit test to explore the most common files. The example comes from the topic Walkthrough: Creating and Running Unit Tests.\r\nParts of a unit test file\r\nWhen you create a unit test, a separate unit test file is created for each class that you are testing. Each unit test file contains a test method for each method that you are testing. In this example, both the methods we are testing belong to the same class. Therefore, there is only one test-class file: BankAccountTest.cs.\r\nTop section of the file\r\nThe following figure shows the first few lines of code, including the reference to the namespaces, the TestClassAttribute, and the TestContext class. See the walkthrough if you want code samples.\r\nTop section of a sample unit test file\r\nMicrosoft.VisualStudio.TestTools.UnitTesting: When you create a unit test, a reference to the Microsoft.VisualStudio.TestTools.UnitTesting namespace is added to your test project and the namespace is included in a using statement at the top of the unit test file. The namespace has many classes to help you with your unit tests including:\r\nAssert classes that you can use to verify conditions in unit tests\r\nInitialization and cleanup attributes to run code before or after unit tests run to ensure a specific beginning and ending state\r\nThe ExpectedException attribute to verify that a certain type of exception is thrown during unit test execution\r\nThe TestContext class which stores information that is provided to unit tests such as data connection for data-driven tests and information that is required to run unit tests for ASP.NET Web Services\r\nFor more information, see Microsoft.VisualStudio.TestTools.UnitTesting.\r\nTestClassAttribute: When you create a unit test the TestClassAttribute is included in the test file to indicate that this particular class may contain methods marked with the [TestMethod()] attribute. Without the TestClassAttribute, the test methods are ignored.\r\nA test class can inherit methods from another test class that is in the same assembly. This means that you can create test methods in a base test class and then use those methods in derived test classes.\r\nFor more information, see TestClassAttribute.\r\nTestContext: When you create unit tests, a variable called testContextInstance is included for each test class. The properties of the TestContext class store information about the current test. For more information, see TestContext.\r\nBottom section of the file\r\nThe following figure shows the latter part of the code that is generated in the walkthrough, which includes the "Additional test attributes" section, the TestMethod attribute, and the logic of the method, which includes an Assert statement.\r\n\r\nhttps://msdn.microsoft.com/en-us/library/ms182517(v=vs.100).aspx\r\n', '2015-11-30 21:28:27', '2015-11-30 21:28:55', 2),
(53, 'HasOne Associations', 2, 'Let’s set up a Users Table with a hasOne relationship to an Addresses Table.\r\n\r\nFirst, your database tables need to be keyed correctly. For a hasOne relationship to work, one table has to contain a foreign key that points to a record in the other. In this case the addresses table will contain a field called user_id. The basic pattern is:\r\n\r\nhasOne: the other model contains the foreign key.\r\n\r\nRelation	Schema\r\nUsers hasOne Addresses	addresses.user_id\r\nDoctors hasOne Mentors	mentors.doctor_id\r\nNote\r\nIt is not mandatory to follow CakePHP conventions, you can override the use of any foreignKey in your associations definitions. Nevertheless sticking to conventions will make your code less repetitive, easier to read and to maintain.\r\nIf we had the UsersTable and AddressesTable classes made we could make the association with the following code:\r\n\r\nclass UsersTable extends Table\r\n{\r\n    public function initialize(array $config)\r\n    {\r\n        $this->hasOne(''Addresses'');\r\n    }\r\n}\r\nIf you need more control, you can define your associations using array syntax. For example, you might want to limit the association to include only certain records:\r\n\r\nclass UsersTable extends Table\r\n{\r\n    public function initialize(array $config)\r\n    {\r\n        $this->hasOne(''Addresses'', [\r\n            ''className'' => ''Addresses'',\r\n            ''conditions'' => [''Addresses.primary'' => ''1''],\r\n            ''dependent'' => true\r\n        ]);\r\n    }\r\n}\r\nPossible keys for hasOne association arrays include:\r\n\r\nclassName: the class name of the table being associated to the current model. If you’re defining a ‘User hasOne Address’ relationship, the className key should equal ‘Addresses’.\r\nforeignKey: the name of the foreign key found in the other table. This is especially handy if you need to define multiple hasOne relationships. The default value for this key is the underscored, singular name of the current model, suffixed with ‘_id’. In the example above it would default to ‘user_id’.\r\nbindingKey: The name of the column in the current table, that will be used for matching the foreignKey. If not specified, the primary key (for example the id column of the Users table) will be used.\r\nconditions: an array of find() compatible conditions such as [''Addresses.primary'' => true]\r\njoinType: the type of the join to use in the SQL query, default is LEFT. You can use INNER if your hasOne association is always present.\r\ndependent: When the dependent key is set to true, and an entity is deleted, the associated model records are also deleted. In this case we set it to true so that deleting a User will also delete her associated Address.\r\ncascadeCallbacks: When this and dependent are true, cascaded deletes will load and delete entities so that callbacks are properly triggered. When false, deleteAll() is used to remove associated data and no callbacks are triggered.\r\npropertyName: The property name that should be filled with data from the associated table into the source table results. By default this is the underscored & singular name of the association so address in our example.\r\nfinder: The finder method to use when loading associated records.\r\nOnce this association has been defined, find operations on the Users table can contain the Address record if it exists:\r\n\r\n // In a controller or table method.\r\n $query = $users->find(''all'')->contain([''Addresses'']);\r\n foreach ($query as $user) {\r\n     echo $user->address->street;\r\n}\r\nThe above would emit SQL that is similar to:', '2015-11-30 21:38:03', '2015-11-30 21:38:03', 1),
(54, 'BelongsTo Associations', 2, 'Now that we have Address data access from the User table, let’s define a belongsTo association in the Addresses table in order to get access to related User data. The belongsTo association is a natural complement to the hasOne and hasMany associations.\r\n\r\nWhen keying your database tables for a belongsTo relationship, follow this convention:\r\n\r\nbelongsTo: the current model contains the foreign key.\r\n\r\nRelation	Schema\r\nAddresses belongsTo Users	addresses.user_id\r\nMentors belongsTo Doctors	mentors.doctor_id\r\nTip\r\nIf a Table contains a foreign key, it belongs to the other Table.\r\nWe can define the belongsTo association in our Addresses table as follows:\r\n\r\nclass AddressesTable extends Table\r\n{\r\n\r\n    public function initialize(array $config)\r\n    {\r\n        $this->belongsTo(''Users'');\r\n    }\r\n}\r\nWe can also define a more specific relationship using array syntax:\r\n\r\nclass AddressesTable extends Table\r\n{\r\n\r\n    public function initialize(array $config)\r\n    {\r\n        $this->belongsTo(''Users'', [\r\n            ''foreignKey'' => ''user_id'',\r\n            ''joinType'' => ''INNER'',\r\n        ]);\r\n    }\r\n}\r\nPossible keys for belongsTo association arrays include:\r\n\r\nclassName: the class name of the model being associated to the current model. If you’re defining a ‘Profile belongsTo User’ relationship, the className key should equal ‘Users’.\r\nforeignKey: the name of the foreign key found in the current table. This is especially handy if you need to define multiple belongsTo relationships to the same model. The default value for this key is the underscored, singular name of the other model, suffixed with _id.\r\nbindingKey: The name of the column in the other table, that will be used for matching the foreignKey. If not specified, the primary key (for example the id column of the Users table) will be used.\r\nconditions: an array of find() compatible conditions or SQL strings such as [''Users.active'' => true]\r\njoinType: the type of the join to use in the SQL query, default is LEFT which may not fit your needs in all situations, INNER may be helpful when you want everything from your main and associated models or nothing at all.\r\npropertyName: The property name that should be filled with data from the associated table into the source table results. By default this is the underscored & singular name of the association so user in our example.\r\nfinder: The finder method to use when loading associated records.\r\nOnce this association has been defined, find operations on the User table can contain the Address record if it exists:\r\n\r\n// In a controller or table method.\r\n$query = $addresses->find(''all'')->contain([''Users'']);\r\nforeach ($query as $address) {\r\n    echo $address->user->username;\r\n}\r\nThe above would emit SQL that is similar to:', '2015-11-30 21:38:47', '2015-11-30 21:38:47', 0),
(55, 'HasMany Associations', 2, 'An example of a hasMany association is “Article hasMany Comments”. Defining this association will allow us to fetch an article’s comments when the article is loaded.\r\n\r\nWhen creating your database tables for a hasMany relationship, follow this convention:\r\n\r\nhasMany: the other model contains the foreign key.\r\n\r\nRelation	Schema\r\nArticle hasMany Comment	Comment.article_id\r\nProduct hasMany Option	Option.product_id\r\nDoctor hasMany Patient	Patient.doctor_id\r\nWe can define the hasMany association in our Articles model as follows:\r\n\r\nclass ArticlesTable extends Table\r\n{\r\n\r\n    public function initialize(array $config)\r\n    {\r\n        $this->hasMany(''Comments'');\r\n    }\r\n}\r\nWe can also define a more specific relationship using array syntax:\r\n\r\nclass ArticlesTable extends Table\r\n{\r\n\r\n    public function initialize(array $config)\r\n    {\r\n        $this->hasMany(''Comments'', [\r\n            ''foreignKey'' => ''article_id'',\r\n            ''dependent'' => true,\r\n        ]);\r\n    }\r\n}\r\nPossible keys for hasMany association arrays include:\r\n\r\nclassName: the class name of the model being associated to the current model. If you’re defining a ‘User hasMany Comment’ relationship, the className key should equal ‘Comment’.\r\nforeignKey: the name of the foreign key found in the other table. This is especially handy if you need to define multiple hasMany relationships. The default value for this key is the underscored, singular name of the actual model, suffixed with ‘_id’.\r\nbindingKey: The name of the column in the current table, that will be used for matching the foreignKey. If not specified, the primary key (for example the id column of the Articles table) will be used.\r\nconditions: an array of find() compatible conditions or SQL strings such as [''Comments.visible'' => true]\r\nsort an array of find() compatible order clauses or SQL strings such as [''Comments.created'' => ''ASC'']\r\ndependent: When dependent is set to true, recursive model deletion is possible. In this example, Comment records will be deleted when their associated Article record has been deleted.\r\ncascadeCallbacks: When this and dependent are true, cascaded deletes will load and delete entities so that callbacks are properly triggered. When false, deleteAll() is used to remove associated data and no callbacks are triggered.\r\npropertyName: The property name that should be filled with data from the associated table into the source table results. By default this is the underscored & plural name of the association so comments in our example.\r\nstrategy: Defines the query strategy to use. Defaults to ‘select’. The other valid value is ‘subquery’, which replaces the IN list with an equivalent subquery.\r\nfinder: The finder method to use when loading associated records.\r\nOnce this association has been defined, find operations on the Articles table can contain the Comment records if they exist:\r\n\r\n// In a controller or table method.\r\n$query = $articles->find(''all'')->contain([''Comments'']);\r\nforeach ($query as $article) {\r\n    echo $article->comments[0]->text;\r\n}\r\nThe above would emit SQL that is similar to:\r\n\r\nSELECT * FROM articles;\r\nSELECT * FROM comments WHERE article_id IN (1, 2, 3, 4, 5);\r\nWhen the subquery strategy is used, SQL similar to the following will be generated:\r\n\r\nSELECT * FROM articles;\r\nSELECT * FROM comments WHERE article_id IN (SELECT id FROM articles);\r\nYou may want to cache the counts for your hasMany associations. This is useful when you often need to show the number of associated records, but don’t want to load all the records just to count them. For example, the comment count on any given article is often cached to make generating lists of articles more efficient. You can use the CounterCacheBehavior to cache counts of associated records.\r\n\r\nYou should make sure that your database tables do not contain columns that match association property names. If for example you have counter fields that conflict with association properties, you must either rename the association property, or the column name.', '2015-11-30 21:39:38', '2015-11-30 21:39:38', 1),
(56, 'BelongsToMany Associations', 2, 'An example of a BelongsToMany association is “Article BelongsToMany Tags”, where the tags from one article are shared with other articles. BelongsToMany is often referred to as “has and belongs to many”, and is a classic “many to many” association.\r\n\r\nThe main difference between hasMany and BelongsToMany is that the link between the models in a BelongsToMany association are not exclusive. For example, we are joining our Articles table with a Tags table. Using ‘funny’ as a Tag for my Article, doesn’t “use up” the tag. I can also use it on the next article I write.\r\n\r\nThree database tables are required for a BelongsToMany association. In the example above we would need tables for articles, tags and articles_tags. The articles_tags table contains the data that links tags and articles together. The joining table is named after the two tables involved, separated with an underscore by convention. In its simplest form, this table consists of article_id and tag_id.\r\n\r\nbelongsToMany requires a separate join table that includes both model names.\r\n\r\nRelationship	Pivot Table Fields\r\nArticle belongsToMany Tag	articles_tags.id, articles_tags.tag_id, articles_tags.article_id\r\nPatient belongsToMany Doctor	doctors_patients.id, doctors_patients.doctor_id, doctors_patients.patient_id.\r\nWe can define the belongsToMany association in our Articles model as follows:\r\n\r\nclass ArticlesTable extends Table\r\n{\r\n\r\n    public function initialize(array $config)\r\n    {\r\n        $this->belongsToMany(''Tags'');\r\n    }\r\n}\r\nWe can also define a more specific relationship using array syntax:\r\n\r\nclass ArticlesTable extends Table\r\n{\r\n\r\n    public function initialize(array $config)\r\n    {\r\n        $this->belongsToMany(''Tags'', [\r\n            ''joinTable'' => ''article_tag'',\r\n        ]);\r\n    }\r\n}\r\nPossible keys for belongsToMany association arrays include:\r\n\r\nclassName: the class name of the model being associated to the current model. If you’re defining a ‘Article belongsToMany Tag’ relationship, the className key should equal ‘Tags.’\r\njoinTable: The name of the join table used in this association (if the current table doesn’t adhere to the naming convention for belongsToMany join tables). By default this table name will be used to load the Table instance for the join/pivot table.\r\nforeignKey: the name of the foreign key found in the current model. This is especially handy if you need to define multiple belongsToMany relationships. The default value for this key is the underscored, singular name of the current model, suffixed with ‘_id’.\r\ntargetForeignKey: the name of the foreign key found in the target model. The default value for this key is the underscored, singular name of the target model, suffixed with ‘_id’.\r\nconditions: an array of find() compatible conditions. If you have conditions on an associated table, you should use a ‘through’ model, and define the necessary belongsTo associations on it.\r\nsort an array of find() compatible order clauses.\r\ndependent: When the dependent key is set to false, and an entity is deleted, the data of the join table will not be deleted.\r\nthrough Allows you to provide a either the name of the Table instance you want used on the join table, or the instance itself. This makes customizing the join table keys possible, and allows you to customize the behavior of the pivot table.\r\ncascadeCallbacks: When this is true, cascaded deletes will load and delete entities so that callbacks are properly triggered on join table records. When false, deleteAll() is used to remove associated data and no callbacks are triggered. This defaults to false to help reduce overhead.\r\npropertyName: The property name that should be filled with data from the associated table into the source table results. By default this is the underscored & plural name of the association, so tags in our example.\r\nstrategy: Defines the query strategy to use. Defaults to ‘select’. The other valid value is ‘subquery’, which replaces the IN list with an equivalent subquery.\r\nsaveStrategy: Either ‘append’ or ‘replace’. Indicates the mode to be used for saving associated entities. The former will only create new links between both side of the relation and the latter will do a wipe and replace to create the links between the passed entities when saving.\r\nfinder: The finder method to use when loading associated records.\r\nOnce this association has been defined, find operations on the Articles table can contain the Tag records if they exist:', '2015-11-30 21:40:29', '2015-11-30 21:40:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `articlestags`
--

CREATE TABLE IF NOT EXISTS `articlestags` (
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`article_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articlestags`
--

INSERT INTO `articlestags` (`article_id`, `tag_id`) VALUES
(6, 7),
(6, 8),
(46, 15),
(46, 18),
(52, 17),
(52, 19),
(53, 15),
(54, 15),
(54, 20),
(55, 15),
(55, 18),
(56, 21);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` varchar(1000) DEFAULT NULL,
  `isApproved` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `article_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`),
  KEY `fk_article_id` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `body`, `isApproved`, `user_id`, `article_id`, `created`, `modified`) VALUES
(30, 'This is an article about using _ids at hasMany relationships', 1, 10, 46, '2015-11-30 21:02:25', '2015-11-30 21:35:38'),
(32, 'Unit Test', 1, 7, 52, '2015-11-30 21:28:40', '2015-11-30 21:33:35'),
(33, 'This is useful for assignment', 0, 10, 46, '2015-11-30 21:34:51', '2015-11-30 21:34:51'),
(34, '2nd Comment will be deleted', 1, 2, 46, '2015-11-30 21:36:02', '2015-11-30 21:36:02'),
(35, 'This is good for assignment', 0, 10, 53, '2015-11-30 21:41:51', '2015-11-30 21:41:51'),
(36, 'This is good for assignment', 0, 10, 52, '2015-11-30 21:42:39', '2015-11-30 21:42:39'),
(37, 'This is good for assignment', 0, 10, 55, '2015-11-30 21:43:20', '2015-11-30 21:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `name`) VALUES
(17, 'basic'),
(21, 'BelongsToMany'),
(20, 'BelongToAssociation'),
(15, 'cakephp'),
(18, 'hasMany Association'),
(19, 'UnitTest');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_user_roles` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role_id`, `created`, `modified`) VALUES
(2, 'admin', '$2y$10$jpSdMSahWRhlQkK6/HW70u.S7dZlGTCxjBoTVwkMnKheZ3oOybXXG', 1, '2015-11-24 23:39:32', '2015-11-30 12:27:39'),
(7, 'francis', '$2y$10$dD9xmNPEX49YbvC2DOK.zeoeMc8kk6J0Z3L0GdkDc1gDNQ4.8BdCC', 2, '2015-11-29 04:45:27', '2015-11-30 12:28:03'),
(10, 'mike', '$2y$10$Y2E8LelHHkv2NZ.e44.Y6.BPiN/YE2upufcQPuTi3DKQ79nYvehmC', 2, '2015-11-30 12:28:15', '2015-11-30 12:28:15');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_articles_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_article_id` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
