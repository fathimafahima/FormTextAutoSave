<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Autosave upgrade script.
 *
 * @package   tinymce_autosave
 * @copyright 2013 fahima
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

function xmldb_tinymce_autosave_upgrade($oldversion) {
    global $DB;
  
    $dbman = $DB->get_manager();
    $result=true;

   if ($oldversion < 2013070900) {

        // Define table mdl_draft to be created
        $table = new xmldb_table('editor_autosave');

        // Adding fields to table mdl_draft
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('editedtime', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('formid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('data', XMLDB_TYPE_TEXT, null, null, null, null, null);
        $table->add_field('attachmentid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');

        // Adding keys to table mdl_draft
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Conditionally launch create table for mdl_draft
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // autosave savepoint reached
        upgrade_plugin_savepoint(true, 2013070900, 'tinymce', 'autosave');
    
}
return $result;
}

    // Moodle v2.4.0 release upgrade line
    // Put any upgrade step following this