<?php
// This file is part of the Lesson Objectives plugin for Moodle - http://moodle.org/
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

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
global $CFG, $DB, $PAGE;
require_once($CFG->dirroot.'/blocks/objectives/lib.php');

$courseid = required_param('course', PARAM_INT);
$weekstart = optional_param('weekstart', null, PARAM_TEXT);

$course = $DB->get_record('course', array('id' => $courseid));
if (!$course) {
    print_error('Invalid courseid');
}

$url = new moodle_url('/blocks/objectives/view.php', array('course' => $course->id));
if ($weekstart != 0) {
    $url->param('weekstart', $weekstart);
}
$PAGE->set_url($url);

require_login($course);

$obj = new block_objectives_class($course);

$obj->view_objectives($weekstart);
