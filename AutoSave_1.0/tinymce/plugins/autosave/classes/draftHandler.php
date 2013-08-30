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
 * AutoSave upgrade script.
 *
 * @package   tinymce_autosave
 * @copyright 2013 fahima
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
/*
 * This class is used to encapsulate the  data such as getting and setting data from the database newly added tables.for the final submission.
 */

//


class draftHandler {

    /**
     * Constructor
     * The first draft data is stored through this
     * @param {int} the id of the last inserted data to the draft table
     */
    function draftHandler($draftData) {
        global $DB;
        $lastInsertedId = $DB->insert_record($draft, $draftData, $returnid = true, $bulk = false);
    }

    /**
     * gets data from draft table for final submission
     * @param {int} $draftId the draft id of the currently using draft
     * @param {Array} $draftData stors all the records related to that draft
     * @return {Array} array of record for that draft
     */
    function getDraftData($formId) {
        global $DB;
        $draftData = $DB->get_record('draft', array('formid' => '$formId'));

        return $draftData;
    }

    /**
     * sets data to draft table whenever data retrieved
     * @param {int} $draftId the draft id of the currently using draft
     * @param {Array} $draftData stors all the records related to that draft
     * @return {Boolean} return true to show successfully saved
     */
    function setDraftData($draftData) {
        global $DB;
        $DB->update_record($draft, $draftData, $bulk = false);


        return true;
    }

}