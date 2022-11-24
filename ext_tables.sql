#
# Add SQL definition of database tables
#


CREATE TABLE pages (
    # Table for faculty definition on site root:
    ku_faculty varchar(255) DEFAULT '' NOT NULL,
    # Table for author in page properties:
    ku_select_author varchar(255) DEFAULT '' NOT NULL,
    ku_lastpageupdates_timestamp int(11) default '0' NOT NULL
);


# Table for faculty definition in backend user settings:
CREATE TABLE be_users (
    ku_user_faculty varchar(255) DEFAULT '' NOT NULL,
);