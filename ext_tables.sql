#
# Add SQL definition of database tables
#

--
-- Table structure for table 'tt_content'
--
CREATE TABLE tt_content (
   tx_ucph_content_bg_color VARCHAR(255) DEFAULT '' NOT NULL,
   tx_ucph_content_background_image int(11) unsigned DEFAULT '0',
   tx_ucph_content_background_image_options mediumtext,
);