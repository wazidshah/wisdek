<?php 
    class BMS_Database {

        private $user_table_name = 'users';
        private $books_table_name = 'books';
        private $borrower_table_name = 'borrower';
        private $notes_table_name = 'notes';

        function create_user_table()
        {
            global $wpdb;
            $table_name = $this->user_table_name;
            $query = "CREATE TABLE `$table_name` ( `UID` int NOT NULL AUTO_INCREMENT PRIMARY KEY, `name` varchar(255) NOT NULL,`surname` varchar(255) NOT NULL, `type` varchar(255) NOT NULL, `has_access` tinyint NOT NULL DEFAULT '1' );";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            maybe_create_table( $table_name ,$query );
        }

        function create_books_table()
        {
            global $wpdb;
            $table_name = $this->books_table_name;
            $query = "CREATE TABLE `$table_name` (
                `BID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `Title` varchar(255) NOT NULL,
                `Author` varchar(255) NOT NULL,
                `Barcode` varchar(255) NOT NULL
              );";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            maybe_create_table( $table_name ,$query );
        }

        function create_borrower_table()
        {
            global $wpdb;
            $table_name = $this->borrower_table_name;
            $query = "CREATE TABLE `$table_name` (
                `BRID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `UID` int NOT NULL,
                `BID` int(11) NOT NULL,
                `Borrowed_date` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
                `Return_date` timestamp NOT NULL,
                `Returned` tinyint NOT NULL DEFAULT '0',
                FOREIGN KEY (`UID`) REFERENCES `users` (`UID`),
                FOREIGN KEY (`BID`) REFERENCES `books` (`BID`)
              );";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            maybe_create_table( $table_name ,$query );
        }

        function create_notes_table()
        {
            global $wpdb;
            $table_name = $this->notes_table_name;
            $query = "CREATE TABLE `$table_name` (
                `NID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `BRID` int NOT NULL,
                `note` varchar(255) NOT NULL,
                FOREIGN KEY (`BRID`) REFERENCES `borrower` (`BRID`)
              );";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            maybe_create_table( $table_name ,$query );
        }

        function initialize_tables()
        {
            $this->create_user_table();
            $this->create_books_table();
            $this->create_borrower_table();
            $this->create_notes_table();
        }

        function insert_borrower($user_id, $book_id, $borrowed_date, $return_timestamp, $returned)
        {
            global $wpdb;

            $table_name = $this->borrower_table_name;

            $query = "INSERT INTO `$table_name` (`UID`, `BID`, `Borrowed_date`, `Return_date`, `Returned`)
            VALUES ('$user_id', '$book_id', '$borrowed_date', '$return_timestamp', '$returned');";

            return $wpdb->query($query);
        }

        function insert_note($borrower_id, $note)
        {
            global $wpdb;

            $table_name = $this->notes_table_name;

            $query = "INSERT INTO `$table_name` (`BRID`, `note`) VALUES ('$borrower_id', '$note');";

            return $wpdb->query($query);
        }

        function get_borrower_note_count($borrower_id) {

            global $wpdb;

            $table_name = $this->borrower_table_name;

            $query = "select count(NID) as note_count from `$table_name` where BRID= '$borrower_id';";

            $results = $wpdb->get_results( $query );

            return $results[0]->note_count;
        }
 
    }

?>