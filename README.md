# PHP-Boostrap-MyQSL-Todo-List
A Todo List with PHP, Boostrap and MySQL

the challenge i faced and how i solved it.

index.php comments

// insert a quote if submit button is clicked
	// if submitting does not work because of 'no default value of the id'
	// run:  SELECT @@SQL_MODE, @@GLOBAL.SQL_MODE;
	//find SQL Mode and remove the STRICT_ALL_TABLES and/or STRICT_TRANS_TABLES and then
	//  run: 'ALTER TABLE card_games MODIFY id int NOT NULL AUTO_INCREMENT;'
	//  after the command 'the id should  set as auto-increment.'
	// do it before you submit for the first time, IF you face issues about it.
	// other you can just move on.
