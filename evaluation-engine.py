#!/usr/bin/env python3
"""
Project: Automated ICT Lab Allocation System (Evaluation Engine)
Author: Riasat Raihan Noor
Date: December 23, 2025

Original Project: https://github.com/riasat97/srdlapp
Live Portal: https://ictdlab.gov.bd/

Description:
This script represents the core evaluation logic derived from the "ICT Lab Allocation" 
national portal, which I designed and developed. The full system manages the 
lifecycle of applications, administrative verification, and local government 
recommendations for distributing digital labs to schools nationwide.

This specific module isolates the final decision-making algorithm that:
1. Filters applications based on strict infrastructure prerequisites.
2. Calculates priority scores using weighted criteria (business logic).
3. Selects the top candidates to meet a fixed government quota.

*Note: While this logic mirrors the production environment, the data generated 
here is synthetic to maintain strict confidentiality of real applicants.*
"""

import random
import logging
import unittest
from typing import List, Tuple
from dataclasses import dataclass, field
from enum import Enum

# --- Configuration & Logging Setup ---
# Configure logging to display INFO level messages and write to file.
logging.basicConfig(
    level=logging.INFO,
    format='%(levelname)s: %(message)s',
    force=True,
    handlers=[
        logging.FileHandler('app.log'),
        logging.StreamHandler()
    ]
)
logger = logging.getLogger(__name__)
logger.setLevel(logging.INFO)

# Mandatory Infrastructure Requirements
REQ_ELECTRICITY = True
REQ_SECURE_ROOM = True
REQ_INTERNET_FEASIBILITY = True

# Prioritization Scoring Weights
# Centralized constants allow for easy policy tuning without breaking logic.
SCORE_LOCAL_GOV_RECOMMENDATION = 50  
SCORE_ADMIN_RECOMMENDATION_BOTH = 30
SCORE_ADMIN_RECOMMENDATION_SINGLE = 15
SCORE_ICT_TEACHER = 25
SCORE_NO_PREVIOUS_LAB = 40
SCORE_BROKEN_PREVIOUS_LAB = 10
SCORE_STUDENT_COUNT_HIGH = 20  # > 500 students
SCORE_STUDENT_COUNT_MED = 10   # 300-500 students
PENALTY_FUNCTIONAL_LAB = -50   

# ---------------------------------------------------------------------------
# Data Model
# ---------------------------------------------------------------------------

class LabStatus(str, Enum):
    """
    Enumeration for the status of a school's existing computer lab.
    """
    NONE = "none"
    BROKEN = "broken"
    FUNCTIONAL = "functional"

@dataclass
class School:
    """
    Represents a single school's application.
    Encapsulates data and logic for self-evaluation.
    """
    # Input Fields
    app_id: int
    school_name: str
    student_count: int
    
    # Infrastructure Data
    has_electricity: bool
    has_secure_room: bool
    has_internet: bool
    
    # Prioritization Data
    has_ict_teacher: bool
    has_local_gov_rec: bool
    sub_district_rec: bool
    district_rec: bool
    previous_lab_status: LabStatus  # Enum enforced

    # Internal State
    is_qualified: bool = field(init=False, default=False)
    priority_score: int = field(init=False, default=0)

    def check_eligibility(self) -> bool:
        """Validates mandatory infrastructure requirements."""
        if (self.has_electricity and 
            self.has_secure_room and 
            self.has_internet):
            self.is_qualified = True
        else:
            self.is_qualified = False
        return self.is_qualified

    def calculate_score(self) -> int:
        """Calculates priority score based on weighted criteria."""
        if not self.is_qualified:
            self.priority_score = 0
            return 0

        score = 0
        
        # Recommendation Scoring
        if self.has_local_gov_rec:
            score += SCORE_LOCAL_GOV_RECOMMENDATION
        if self.sub_district_rec and self.district_rec:
            score += SCORE_ADMIN_RECOMMENDATION_BOTH
        elif self.sub_district_rec or self.district_rec:
            score += SCORE_ADMIN_RECOMMENDATION_SINGLE

        # Student Count Scoring
        if self.student_count > 500:
            score += SCORE_STUDENT_COUNT_HIGH
        elif 300 <= self.student_count <= 500:
            score += SCORE_STUDENT_COUNT_MED

        # Resource Scoring
        if self.has_ict_teacher:
            score += SCORE_ICT_TEACHER
        
        # Previous Lab Status (Enum comparison)
        if self.previous_lab_status == LabStatus.NONE:
            score += SCORE_NO_PREVIOUS_LAB
        elif self.previous_lab_status == LabStatus.BROKEN:
            score += SCORE_BROKEN_PREVIOUS_LAB
        elif self.previous_lab_status == LabStatus.FUNCTIONAL:
            score += PENALTY_FUNCTIONAL_LAB

        self.priority_score = score
        return score

# ---------------------------------------------------------------------------
# Core Logic
# ---------------------------------------------------------------------------

def select_schools(schools: List[School], quota: int) -> Tuple[List[School], List[School]]:
    """
    Filters, scores, and selects schools under a fixed quota.
    
    Returns:
        Tuple containing (List of Selected Schools, List of Waitlisted Schools)
    """
    # Defensive Programming: Validate Inputs
    if quota < 0:
        raise ValueError(f"Quota cannot be negative. Received: {quota}")
    if not schools:
        logger.warning("Input school list is empty. Returning empty selection.")
        return [], []

    logger.info(f"Processing {len(schools)} applications for quota: {quota}...")
    eligible_schools = []

    # 1. Filter and Score
    for school in schools:
        if school.check_eligibility():
            school.calculate_score()
            eligible_schools.append(school)

    # 2. Sort
    # Sort by Priority Score (Desc), then Student Count (Desc) as tie-breaker
    eligible_schools.sort(key=lambda x: (x.priority_score, x.student_count), reverse=True)

    # 3. Slice
    selected = eligible_schools[:quota]
    waitlisted = eligible_schools[quota:]
    
    logger.info(f"Selection complete. {len(selected)} selected, {len(waitlisted)} waitlisted.")
    return selected, waitlisted

def generate_mock_data(total_apps: int = 15000) -> List[School]:
    """Generates dummy data for simulation."""
    logger.info(f"Generating {total_apps} mock applications...")
    data = []
    
    # Pre-define weights for Enum choices
    status_choices = [LabStatus.NONE, LabStatus.BROKEN, LabStatus.FUNCTIONAL]
    status_weights = [0.7, 0.2, 0.1]

    for i in range(1, total_apps + 1):
        app = School(
            app_id=i,
            school_name=f"School_{i}",
            student_count=random.randint(100, 1200),
            has_electricity=random.choices([True, False], weights=[0.8, 0.2])[0],
            has_secure_room=random.choices([True, False], weights=[0.7, 0.3])[0],
            has_internet=random.choices([True, False], weights=[0.6, 0.4])[0],
            has_ict_teacher=random.choice([True, False]),
            has_local_gov_rec=random.choices([True, False], weights=[0.05, 0.95])[0],
            sub_district_rec=random.choice([True, False]),
            district_rec=random.choice([True, False]),
            previous_lab_status=random.choices(status_choices, weights=status_weights)[0]
        )
        data.append(app)
    return data

# ---------------------------------------------------------------------------
# Unit Tests
# ---------------------------------------------------------------------------

class TestLabAllocation(unittest.TestCase):
    """
    Unit tests to verify business logic and selection algorithms.
    """
    def setUp(self):
        # Create a sample school that is perfectly eligible and has high specs
        self.s1 = School(
            app_id=1, school_name="Test School", student_count=600, 
            has_electricity=True, has_secure_room=True, has_internet=True, 
            has_ict_teacher=True, has_local_gov_rec=True, 
            sub_district_rec=True, district_rec=True, 
            previous_lab_status=LabStatus.NONE
        )

    def test_eligibility_logic(self):
        self.s1.has_electricity = False
        self.assertFalse(self.s1.check_eligibility(), "School without electricity should fail.")
        
        self.s1.has_electricity = True
        self.assertTrue(self.s1.check_eligibility(), "School with all infra should pass.")

    def test_scoring_logic(self):
        """
        Verify that the score summation matches the business rules defined in constants.
        """
        self.s1.check_eligibility()
        
        # Dynamically calculate expected score based on constants
        # This ensures the test remains valid even if we tune the weights later.
        expected_score = (
            SCORE_LOCAL_GOV_RECOMMENDATION + 
            SCORE_ADMIN_RECOMMENDATION_BOTH + 
            SCORE_STUDENT_COUNT_HIGH + 
            SCORE_ICT_TEACHER + 
            SCORE_NO_PREVIOUS_LAB
        )
        
        self.assertEqual(self.s1.calculate_score(), expected_score)

    def test_negative_quota_raises_error(self):
        with self.assertRaises(ValueError):
            select_schools([self.s1], -5)

# ---------------------------------------------------------------------------
# Main Execution
# ---------------------------------------------------------------------------
if __name__ == "__main__":
    
    # To run unit tests instead of simulation, uncomment the following line:
    # unittest.main()

    try:
        print("Starting Application...")
        
        # 1. Setup
        QUOTA = 5000
        
        # 2. Ingest Data
        all_applications = generate_mock_data(total_apps=15000)
        
        # 3. Process Logic
        selected_schools, waitlisted_schools = select_schools(all_applications, QUOTA)
        
        # 4. Report
        print("\n" + "="*60)
        print(" FINAL SELECTION REPORT ")
        print("="*60)
        
        if len(selected_schools) > 0:
            cutoff = selected_schools[-1].priority_score
            print(f"Quota Full. Cutoff Score: {cutoff}")
            
        print("-" * 60)
        # Using f-string formatting (<6, <8) to create a clean aligned table
        print(f"{'Rank':<6} | {'ID':<8} | {'Score':<6} | {'Students':<8} | {'Gov Rec':<8} | {'Status'}")
        print("-" * 60)
        
        for idx, school in enumerate(selected_schools[:10]):
            rec = "YES" if school.has_local_gov_rec else "NO"
            print(f"{idx+1:<6} | {school.app_id:<8} | {school.priority_score:<6} | "
                  f"{school.student_count:<8} | {rec:<8} | SELECTED")
                  
        print("...\n[List truncated]")

    except ValueError as e:
        logger.error(f"Configuration Error: {e}")
    except Exception as e:
        logger.critical(f"Unexpected System Error: {e}")
