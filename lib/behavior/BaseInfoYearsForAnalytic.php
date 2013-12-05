<?php
/*
 * Kimkëlen - School Management Software
 * Copyright (C) 2013 CeSPI - UNLP <desarrollo@cespi.unlp.edu.ar>
 *
 * This file is part of Kimkëlen.
 *
 * Kimkëlen is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License v2.0 as published by
 * the Free Software Foundation.
 *
 * Kimkëlen is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Kimkëlen.  If not, see <http://www.gnu.org/licenses/gpl-2.0.html>.
 */ ?>
<?php

 class BaseInfoYearsForAnalytic
 {

 	public function __construct ($scsys)
   {

		$this->scsys = $scsys;

   }

   public function getYearFromSchoolYear($sy_id, $student){

      $school_year = SchoolYearPeer::retrieveByPK($sy_id); 
      $student_career_school_year = StudentCareerSchoolYearPeer::retrieveCareerSchoolYearForStudentAndYear($student, $school_year);

      
      return $student_career_school_year[0]->getYear();

   }

   public function getAverageForSchoolYear($sy_id, $student)
   {

   		//Calcular promedio para un school_year
      $school_year = SchoolYearPeer::retrieveByPK($sy_id); 

      $student_career_school_year = StudentCareerSchoolYearPeer::retrieveCareerSchoolYearForStudentAndYear($student, $school_year);
 
      return  $student_career_school_year[0]->getAnualAverage()
       ?  $student_career_school_year[0]->getAnualAverage()
       : $this->getNullAverage();

   }


   public function getNullAverage(){
      return "--";
   }

   public function getSubjectsFromSchoolYear($sy)
   {
   		
   }

   public function getSubjectsForAllSchoolYears(){
      
      foreach ($this->scsys as $key => $scsy) {

        $css = SchoolBehaviourFactory::getInstance()->getCourseSubjectStudentsForAnalytics($scsy->getStudent(), $scsy->getSchoolYear());

        if(!isset($ret[$key])){
          $ret[$key] = array();
        }

        $ret[$key][] = $css;
        
      }

      return $ret;
   }

 }