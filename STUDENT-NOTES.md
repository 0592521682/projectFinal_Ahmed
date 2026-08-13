```markdown
# STUDENT NOTES

## Student Information

- **Student Name:** أحمد محمود عادل صبيح
- **Academic ID:** 2049011058

---

## Project Overview

This project implements a maintenance request management system that allows users to create, view, search, filter, update, and manage maintenance requests according to their roles and permissions.

The implemented functionality covers maintenance requests, validation, pagination, authorization, technician assignment, and customer ratings.

---

## Completed Tasks

### Task 4 – Search and Filtering

The maintenance request list supports:

- Searching by request title.
- Searching by customer name.
- Filtering by status.
- Filtering by priority.
- Filtering by technician.
- Combining multiple filters in a single search.
- Displaying all requests when no filters are selected.

### Task 5 – Pagination

- Added pagination to the maintenance request list.
- Preserved search and filter parameters between pages.
- Verified that filtering continues to work while navigating through paginated results.

### Task 6 – Create Maintenance Request

The request creation form includes:

- Customer.
- Optional Technician.
- Title.
- Description.
- Priority.
- Requested Date.

Submitted information is validated and stored in the database, with newly created requests receiving the appropriate initial status.

### Task 7 – Validation

Validation was implemented for the main request fields:

- Title is required and has a reasonable length.
- Description is required.
- Customer ID must exist in the customers table.
- Technician ID, when provided, must exist and belong to a technician.
- Priority must contain an allowed value.
- Status must contain an allowed value.
- Requested date must be a valid date.
- Validation errors are returned to the user.

### Task 8 – Update / Edit

- Existing request information is displayed in the edit form.
- Customer can be changed.
- Technician can be changed.
- Priority can be changed.
- Status can be changed.
- Submitted changes are validated.
- Updated information is saved in the database.
- A success message is displayed after a successful update.

### Task 9 – Authorization

Role-based access control was implemented for maintenance requests.

- Admin users can manage requests according to the project requirements.
- Technician access is limited according to the assigned request.
- Restricted update and delete operations are protected on the backend.
- Authorization is enforced through application logic and is not based only on hiding interface buttons.

### Task 10 – Rating

The rating functionality follows the required rules:

- Rating is available only after a request is completed.
- The customer must be the customer associated with the request.
- Rating value must be between 1 and 5.
- Comment is optional.
- A request can have only one rating.

### Task 11 – Debugging

During development, several issues were identified and corrected, including:

- Incorrect model relationships.
- Missing validation rules.
- Missing request fields in the Store operation.
- Incomplete search and filtering logic.
- Route model binding issues.
- PHP namespace and syntax issues.
- Composer dependency and autoload problems.

The application was re-tested after the fixes.

---

## Project Assumptions

- Every maintenance request belongs to one customer.
- A request may be assigned to one technician or remain unassigned.
- Only users with the `technician` role can be assigned as technicians.
- Newly created requests use `pending` as their initial status.
- Ratings are submitted only after the related request has been completed.
- Each maintenance request has a single rating.

---

## Main Changes

The main project changes include:

- Updated `MaintenanceRequestController`.
- Implemented request search and filtering.
- Added pagination with preserved query parameters.
- Implemented request creation.
- Added Store and Update validation.
- Implemented request editing.
- Added Customer, Technician and Rating relationships.
- Added technician role checking.
- Added rating validation.
- Added route model binding for maintenance requests.
- Added backend authorization checks.
- Corrected Composer dependencies and generated autoload files.
- Corrected PHP namespace and controller issues.
- Verified project routes and database migrations.

---

## Testing and Verification

The following tests and checks were performed:

- Maintenance Requests page loads successfully.
- New maintenance request was created successfully.
- Created request was verified in the database.
- Search by request title was tested.
- Search by customer name was tested.
- Status filter was tested.
- Priority filter was tested.
- Technician filter was tested.
- Multiple filters were tested together.
- Request creation with valid data was tested.
- Request validation with incomplete data was tested.
- Request validation with invalid values was tested.
- Existing request editing was tested.
- Request status changes were tested.
- Rating validation was tested.
- Laravel routes were checked using `php artisan route:list`.
- Database migrations were checked using `php artisan migrate:status`.
- Application was run using `php artisan serve`.
- PHP syntax was checked for the relevant controllers.
- The application was re-tested after debugging changes.

---

## Final Status

The required maintenance request features have been implemented and tested.

The project currently includes:

- Maintenance request management.
- Search and filtering.
- Pagination.
- Request creation.
- Request validation.
- Request editing.
- Role-based authorization.
- Technician assignment.
- Customer ratings.
- Database relationships.
- Debugging and verification.

The project was tested locally and the main implemented functions are working together as required.
```
