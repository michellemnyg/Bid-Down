# Bid Down - Features Breakdown & Task List

This document outlines the core features of the "Bid Down" platform, divided into Frontend (UI/UX improvements) and Backend (Logic/Data) tasks. Use this checklist to track progress, especially for the UI redesign phase.

## 1. Authentication & Onboarding
- [x] **Frontend (UI/UX)**
  - [x] Redesign Login Page: Improve layout, add responsive design, and form validation feedback.
  - [x] Redesign Register Page: Improve layout for selecting roles (Client vs Freelancer) and form aesthetics.
  - [x] Fix role selection toggle: Ensure the selected role (Client/Freelancer) is visually distinct.
  - [x] Add Show Password toggle: Implement show/hide password functionality on both login and register forms.
  - [x] Add Website Link input: Only show for Client registration.
  - [x] Add WhatsApp Number input: Only show for Freelancer registration.
  - [x] Auto-format WhatsApp input: Automatically insert hyphens (e.g., `0800-0000-0000`) for the WhatsApp input.
- [ ] **Backend**
  - [ ] `AuthController@login`: Handle authentication logic.
  - [ ] `AuthController@register`: Handle user registration and role assignment.
  - [ ] `AuthController@logout`: Handle session destruction.

## 2. Dashboards & Global UI
- [x] **Global UI / Component Improvements**
  - [x] Auto-hide Flash Notifications: Make all success/error popups auto-dismiss after 4 seconds.
  - [x] Action Confirmation Modals: Implement SweetAlert or Bootstrap modals before critical actions (Create, Edit, Delete Project, Choose Winner, Submit Bid, Withdraw Bid).
- [x] **Frontend (UI/UX)**
  - [x] Redesign Client Dashboard (`/dashboardclient`): Modernize and clean up UI, use `layouts.app`, clean up tables (remove unused columns), show active projects, recent bids received, and quick stats.
  - [x] Redesign Freelancer Dashboard (`/dashboardfreelancer`): Modernize and clean up UI, use `layouts.app`, clean up tables (remove unused columns), show active bids, won projects, and recommended projects to bid on.
- [ ] **Backend**
  - [ ] `PageController@dashboardClient`: Fetch client's projects and aggregated bid data.
  - [ ] `PageController@dashboardFreelancer`: Fetch freelancer's active bids and relevant statistics.

## 3. Project Discovery & Management
- [x] **Frontend (UI/UX)**
  - [x] Explore Page (`/explore`): Create a visually appealing project listing with search, filtering (by budget, category), and pagination.
  - [x] Make Project Page (`/make-project`): Redesign the project creation form with a step-by-step or clean single-page layout.
  - [x] Edit Project Page (Client): Form UI to edit an existing project before it is taken.
  - [x] Project Detail Client (`/projectdetailclient`): UI for the client to view their project details and a list of received bids (with options to accept/reject).
  - [x] Project Detail Freelancer (`/projectdetailfreelancer`): UI for the freelancer to view project requirements and submit a bid.
- [ ] **Backend**
  - [ ] `PageController@explore`: Query projects with active status.
  - [ ] `ProjectController@store`: Validate and save new projects.
  - [ ] `ProjectController@close`: Logic to close a project once a bid is accepted.
  - [ ] Fetch project details for client/freelancer views.

## 4. Bidding System & Project Lifecycle
- [x] **Frontend (UI/UX)**
  - [x] Bid Submission UI: Modal/inline form on Freelancer Project Detail page.
  - [x] Bid List UI: List/table on Client Project Detail page to compare bids.
  - [x] **Bidding Lock & Timer**: Lock the bidding area when the countdown timer hits zero or a winner is selected. Change badge status and timer text accordingly (e.g., "Bidding Ditutup").
  - [x] **Exclusive Contact Section**: Show Client/Freelancer contact details (WhatsApp, Email) on the Project Detail page *only* after a winner is chosen, exclussively to the Client and the winner.
  - [x] **Two-Way Review System**: UI to submit and view reviews (Client <-> Freelancer) after the client marks the project as "Selesai".
- [ ] **Backend**
  - [ ] `BidController@store`: Validate and save bids.
  - [ ] Prevent duplicate bids, or bids on closed/expired projects.
  - [ ] Logic to select a winner and lock the project.
  - [ ] `ProjectController@markCompleted`: Endpoint for client to confirm project completion off-platform.
  - [ ] `ReviewController@store`: Save two-way reviews linked to profiles.

## 5. User Profiles & Portfolios
- [x] **Frontend (UI/UX)**
  - [x] Edit Profile Page (`/editprofilefreelancer`): Form to update personal info, skills, portfolio, and profile picture. Implement `layouts.app`.
  - [x] Profile Client (`/profileclient`): Public/private view, including received reviews. Implement `layouts.app`.
  - [x] Profile Freelancer (`/profilefreelancer`): Public view, including ratings and portfolio. Implement `layouts.app`.
- [ ] **Backend**
  - [ ] `ProfileController@updateFreelancer`: Handle updates and file uploads (if any).
  - [ ] Fetch profile and aggregated review data.

---

*Note: Since the goal is to improve the appearance of several pages, prioritize the **Frontend (UI/UX)** tasks in the Dashboards, Explore, and Project Detail pages first, as those are the core of the user experience.*
