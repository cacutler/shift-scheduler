# Shift Scheduler

This is a shift scheduling tool for businesses to use for assigning shifts to employees.  It is built with the Laravel framework for the backend and the Vue framework for the frontend.

## Features

- Managers can create new shifts and assign available shifts to employees, other managers, and self-assign their own shifts.
- Employees can self-assign available shifts and unassign currently assigned shifts (possible additional feature would be to add an approval system for managers to use for employees needing to unassign shifts).
- Managers can also delete extra shifts and assign other managers.
- Everyone can manage their own profile and managers can edit needed information on everyone's profile (new feature).

## REST Endpoints

| Name | Method | Path | Middleware |
| ---- | ------ | ---- | ---------- |

## Database Design

**Users**

- ID
- Name
- Status (enum type of either employee or manager)
- Username
- Email
- Phone Number
- Password

**Shifts**

- ID
- User ID
- Start Date
- Start Time
- End Date
- End Time