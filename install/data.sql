CREATE TABLE sil_user (
  id Int(11) NOT NULL auto_increment,
  user VarChar(50) NOT NULL default '',
  pass VarChar(50) NOT NULL default '',
  mail VarChar(50) NOT NULL default '',
  profile_name VarChar(50) NOT NULL default '',
  profile_avatar VarChar(50) NOT NULL default '',
  profile_icq VarChar(50) NOT NULL default '',
  profile_msn VarChar(50) NOT NULL default '',
  profile_jabber VarChar(50) NOT NULL default '',
  profile_page VarChar(50) NOT NULL default '',
  profile_date VarChar(50) NOT NULL default '',
  PRIMARY KEY (id)
)  