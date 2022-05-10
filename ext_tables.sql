#
# Add SQL definition of database tables
#
# Table for faculty definition:
CREATE TABLE pages (
    ku_faculty varchar(255) DEFAULT '' NOT NULL,
);

CREATE TABLE be_users (
    ku_user_faculty varchar(255) DEFAULT '' NOT NULL,
);