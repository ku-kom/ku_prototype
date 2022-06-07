#
# Add SQL definition of database tables
#

# Table for faculty definition on site root:
CREATE TABLE pages (
    ku_faculty varchar(255) DEFAULT '' NOT NULL,
);

# Table for faculty definition in backend user settings:
CREATE TABLE be_users (
    ku_user_faculty varchar(255) DEFAULT '' NOT NULL,
);