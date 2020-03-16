# $Id: rssc.sql,v 1.3 2012/04/08 23:42:21 ohwada Exp $

# 2012-04-02 K.OHWADA
# link table
#   varchar -> text
#   url, rdf_url, rss_url, atom_url
# feed table
#   varchar -> text
#   site_link, entry_id, guid, author_uri, enclosure_url, 
#   media_content_url, media_thumbnail_url

# 2011-12-29 K.OHWADA
# TYPE=MyISAM -> ENGINE=MyISAM

# 2010-04-18 K.OHWADA
# BLOB/TEXT column 'link' can't have a default value

# 2009-09-27 K.OHWADA
# KEY act_time udi_time in feed table

# 2009-03-14 K.OHWADA
# change INSERT

# 2009-02-20 K.OHWADA
# gicon_id in link table
# geo_lat in feed table

# 2008-02-24 K.OHWADA
# change varchar to text (64KB)
#   link in feed

# 2008-01-20 K.OHWADA
# add field post_plugin in link
# change attribute censor plugin in link

# 2007-11-26 K.OHWADA
# BLOB and TEXT columns cannot have DEFAULT values.

# 2007-11-01 K.OHWADA
# add field enclosure censor plugin in link
# add field cache ctime in black, white

# 2007-06-01 K.OHWADA
# add table xml, word
# add field act in feed
# add field act reg count in black, white

# 2006-09-01 K.OHWADA
# add conf_valuetype

# 2006-07-08 K.OHWADA
# corresponding to podcast

# =========================================================
# RSS Center Module
# 2006-01-01 K.OHWADA
# =========================================================

#
# Table structure for table `rssc_config`
# modify from system `config`
#

CREATE TABLE rssc_config (
    id             SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    conf_id        SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0,
    conf_name      VARCHAR(255)         NOT NULL DEFAULT '',
    conf_valuetype VARCHAR(255)         NOT NULL DEFAULT '',
    conf_value     TEXT                 NOT NULL,
    aux_int_1      INT(5)                        DEFAULT '0',
    aux_int_2      INT(5)                        DEFAULT '0',
    aux_text_1     VARCHAR(255)                  DEFAULT '',
    aux_text_2     VARCHAR(255)                  DEFAULT '',
    PRIMARY KEY (id),
    KEY conf_id (conf_id)
)
    ENGINE = MyISAM;
# --------------------------------------------------------

#
# Table structure for table `rssc_link`
#

CREATE TABLE rssc_link (
    lid          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    uid          INT(11) UNSIGNED      DEFAULT '0',
    mid          INT(11) UNSIGNED      DEFAULT '0',
    p1           INT(11) UNSIGNED      DEFAULT '0',
    p2           INT(11) UNSIGNED      DEFAULT '0',
    p3           INT(11) UNSIGNED      DEFAULT '0',
    title        VARCHAR(255)          DEFAULT '',
    url          TEXT             NOT NULL,
    ltype        TINYINT(2) UNSIGNED   DEFAULT '0',
    refresh      MEDIUMINT(8) UNSIGNED DEFAULT '3600',
    headline     MEDIUMINT(8) UNSIGNED DEFAULT '0',
    mode         TINYINT(3)            DEFAULT '0',
    rdf_url      TEXT             NOT NULL,
    rss_url      TEXT             NOT NULL,
    atom_url     TEXT             NOT NULL,
    encoding     VARCHAR(15)           DEFAULT '',
    updated_unix INT(10)               DEFAULT '0',
    channel      TEXT             NOT NULL,
    xml          MEDIUMTEXT       NOT NULL,
    aux_int_1    INT(5)                DEFAULT '0',
    aux_int_2    INT(5)                DEFAULT '0',
    aux_text_1   VARCHAR(255)          DEFAULT '',
    aux_text_2   VARCHAR(255)          DEFAULT '',
    enclosure    TINYINT(2)            DEFAULT '1',
    censor       TEXT             NOT NULL,
    plugin       TEXT             NOT NULL,
    post_plugin  TEXT             NOT NULL,
    icon         VARCHAR(255)          DEFAULT '',
    gicon_id     INT(10)               DEFAULT '0',
    PRIMARY KEY (lid),
    KEY mid (mid),
    KEY p (p1, p2, p3)
)
    ENGINE = MyISAM;
# --------------------------------------------------------

#
# Table structure for table `rssc_xml`
#

CREATE TABLE rssc_xml (
    xid        INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    lid        INT(11) UNSIGNED DEFAULT '0',
    xml        MEDIUMTEXT       NOT NULL,
    aux_int_1  INT(5)           DEFAULT '0',
    aux_int_2  INT(5)           DEFAULT '0',
    aux_text_1 VARCHAR(255)     DEFAULT '',
    aux_text_2 VARCHAR(255)     DEFAULT '',
    PRIMARY KEY (xid),
    KEY lid (lid)
)
    ENGINE = MyISAM;
# --------------------------------------------------------

#
# Table structure for table `rssc_feed`
#

CREATE TABLE rssc_feed (
    fid                    INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    lid                    INT(11) UNSIGNED NOT NULL DEFAULT '0',
    uid                    INT(11) UNSIGNED          DEFAULT '0',
    mid                    INT(11) UNSIGNED          DEFAULT '0',
    p1                     INT(11) UNSIGNED          DEFAULT '0',
    p2                     INT(11) UNSIGNED          DEFAULT '0',
    p3                     INT(11) UNSIGNED          DEFAULT '0',
    site_title             VARCHAR(255)              DEFAULT '',
    site_link              TEXT             NOT NULL,
    title                  VARCHAR(255)     NOT NULL DEFAULT '',
    link                   TEXT             NOT NULL,
    entry_id               TEXT             NOT NULL,
    guid                   TEXT             NOT NULL,
    updated_unix           INT(10)                   DEFAULT '0',
    published_unix         INT(10)                   DEFAULT '0',
    category               VARCHAR(255)              DEFAULT '',
    author_name            VARCHAR(255)              DEFAULT '',
    author_uri             TEXT             NOT NULL,
    author_email           VARCHAR(255)              DEFAULT '',
    type_cont              VARCHAR(255)              DEFAULT '',
    raws                   TEXT             NOT NULL,
    content                TEXT             NOT NULL,
    search                 TEXT             NOT NULL,
    enclosure_url          TEXT             NOT NULL,
    enclosure_type         VARCHAR(255)              DEFAULT '',
    enclosure_length       INT(5)                    DEFAULT '0',
    aux_int_1              INT(5)                    DEFAULT '0',
    aux_int_2              INT(5)                    DEFAULT '0',
    aux_text_1             VARCHAR(255)              DEFAULT '',
    aux_text_2             VARCHAR(255)              DEFAULT '',
    act                    TINYINT(1)                DEFAULT '1',
    geo_lat                FLOAT(10, 6)     NOT NULL,
    geo_long               FLOAT(10, 6)     NOT NULL,
    media_content_url      TEXT             NOT NULL,
    media_content_type     VARCHAR(255)              DEFAULT '',
    media_content_medium   VARCHAR(255)              DEFAULT '',
    media_content_filesize INT(10)                   DEFAULT '0',
    media_content_width    INT(10)                   DEFAULT '0',
    media_content_height   INT(10)                   DEFAULT '0',
    media_thumbnail_url    TEXT             NOT NULL,
    media_thumbnail_width  INT(10)                   DEFAULT '0',
    media_thumbnail_height INT(10)                   DEFAULT '0',
    PRIMARY KEY (fid),
    KEY lid (lid),
    KEY mid (mid),
    KEY p (p1, p2, p3),
    KEY act_time (act, updated_unix, published_unix),
    KEY uid_time (uid, updated_unix, published_unix),
    KEY link (link(10)),
    KEY updated (updated_unix),
    KEY published (published_unix)
)
    ENGINE = MyISAM;
# --------------------------------------------------------

#
# Table structure for table `rssc_black`
#

CREATE TABLE rssc_black (
    bid        INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    lid        INT(11) UNSIGNED          DEFAULT '0',
    uid        INT(11) UNSIGNED          DEFAULT '0',
    mid        INT(11) UNSIGNED          DEFAULT '0',
    p1         INT(11) UNSIGNED          DEFAULT '0',
    p2         INT(11) UNSIGNED          DEFAULT '0',
    p3         INT(11) UNSIGNED          DEFAULT '0',
    title      VARCHAR(255)              DEFAULT '',
    url        VARCHAR(255)     NOT NULL DEFAULT '',
    memo       TEXT             NOT NULL,
    aux_int_1  INT(5)                    DEFAULT '0',
    aux_int_2  INT(5)                    DEFAULT '0',
    aux_text_1 VARCHAR(255)              DEFAULT '',
    aux_text_2 VARCHAR(255)              DEFAULT '',
    act        TINYINT(1)                DEFAULT '1',
    reg        TINYINT(1)                DEFAULT '0',
    count      INT(11) UNSIGNED          DEFAULT '0',
    cache      INT(11) UNSIGNED          DEFAULT '0',
    ctime      INT(11) UNSIGNED          DEFAULT '0',
    PRIMARY KEY (bid)
)
    ENGINE = MyISAM;
# --------------------------------------------------------

#
# Table structure for table `rssc_white`
#

CREATE TABLE rssc_white (
    wid        INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    lid        INT(11) UNSIGNED          DEFAULT '0',
    uid        INT(11) UNSIGNED          DEFAULT '0',
    mid        INT(11) UNSIGNED          DEFAULT '0',
    p1         INT(11) UNSIGNED          DEFAULT '0',
    p2         INT(11) UNSIGNED          DEFAULT '0',
    p3         INT(11) UNSIGNED          DEFAULT '0',
    title      VARCHAR(255)              DEFAULT '',
    url        VARCHAR(255)     NOT NULL DEFAULT '',
    memo       TEXT             NOT NULL,
    aux_int_1  INT(5)                    DEFAULT '0',
    aux_int_2  INT(5)                    DEFAULT '0',
    aux_text_1 VARCHAR(255)              DEFAULT '',
    aux_text_2 VARCHAR(255)              DEFAULT '',
    act        TINYINT(1)                DEFAULT '1',
    reg        TINYINT(1)                DEFAULT '0',
    count      INT(11) UNSIGNED          DEFAULT '0',
    cache      INT(11) UNSIGNED          DEFAULT '0',
    ctime      INT(11) UNSIGNED          DEFAULT '0',
    PRIMARY KEY (wid)
)
    ENGINE = MyISAM;
# --------------------------------------------------------

#
# Table structure for table `rssc_word`
#

CREATE TABLE rssc_word (
    sid        INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    word       VARCHAR(255)     DEFAULT '',
    reg        TINYINT(1)       DEFAULT '0',
    point      INT(11) UNSIGNED DEFAULT '0',
    count      INT(11) UNSIGNED DEFAULT '0',
    aux_int_1  INT(5)           DEFAULT '0',
    aux_int_2  INT(5)           DEFAULT '0',
    aux_text_1 VARCHAR(255)     DEFAULT '',
    aux_text_2 VARCHAR(255)     DEFAULT '',
    PRIMARY KEY (sid),
    KEY point (point, count)
)
    ENGINE = MyISAM;
# --------------------------------------------------------

INSERT INTO rssc_link
VALUES (1, 1, 0, 0, 0, 0, 'XOOPS.org', 'https://www.xoops.org/', 2, 3600, 1, 2, '', 'https://www.xoops.org/backend.php', '', 'utf-8', 0, '', '', 0, 0, '', '', 1, '', '', '', '', 0);
INSERT INTO rssc_xml
VALUES (1, 1, '', 0, 0, '', '');
