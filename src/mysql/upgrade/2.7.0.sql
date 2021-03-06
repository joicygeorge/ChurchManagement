ALTER TABLE group_grp
  ADD COLUMN grp_active BOOLEAN NOT NULL DEFAULT 1 AFTER grp_hasSpecialProps,
  ADD COLUMN grp_include_email_export BOOLEAN NOT NULL DEFAULT 1 AFTER grp_active;

UPDATE `menuconfig_mcf` SET content_english = 'View Active Families', `content` = 'View Active Families' WHERE `mid` = 15;

INSERT INTO `menuconfig_mcf` (`mid`, `name`, `parent`, `ismenu`, `content_english`, `content`, `uri`, `statustext`, `security_grp`, `session_var`, `session_var_in_text`, `session_var_in_uri`, `url_parm_name`, `active`, `sortorder`, `icon`) VALUES
  (16, 'viewfamilyinactive', 'people', 0, 'View Inactive Families', 'View Inactive Families', 'FamilyList.php?mode=inactive', '', 'bAll', NULL, 0, 0, NULL, 1, 6, NULL);

ALTER TABLE queryparameteroptions_qpo
  MODIFY qpo_Value VARCHAR(255) NOT NULL DEFAULT '';

UPDATE queryparameteroptions_qpo SET qpo_Value = 'CONCAT(COALESCE(`per_FirstName`,''),COALESCE(`per_MiddleName`,''),COALESCE(`per_LastName`,''))'
WHERE qpo_ID = 5;

UPDATE query_qry SET qry_SQL = 'SELECT per_ID as AddToCart, CONCAT(''<a href=PersonView.php?PersonID='',per_ID,''>'',COALESCE(`per_FirstName`,''''),'' '',COALESCE(`per_MiddleName`,''''),'' '',COALESCE(`per_LastName`,''''),''</a>'') AS Name, fam_City as City, fam_State as State, fam_Zip as ZIP, per_HomePhone as HomePhone, per_Email as Email, per_WorkEmail as WorkEmail FROM person_per RIGHT JOIN family_fam ON family_fam.fam_id = person_per.per_fam_id WHERE ~searchwhat~ LIKE ''%~searchstring~%'''
WHERE qry_ID = 15;

DELETE FROM userconfig_ucfg where ucfg_name = "sFromEmailAddress";
DELETE FROM userconfig_ucfg where ucfg_name = "sFromName";
DELETE FROM userconfig_ucfg where ucfg_name = "bSendPHPMail";

ALTER TABLE event_attend ADD attend_id INT PRIMARY KEY AUTO_INCREMENT FIRST;
