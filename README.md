# Form Builder

A dynamic form builder built with Laravel and vanilla JavaScript. Allows users to visually create forms by dragging and dropping fields onto a canvas, configuring field options, and exporting the result as a JSON schema.

---

## Features

- **Drag & Drop** — Drag fields from the panel onto the canvas to build your form visually
- **18 Field Types** — Text, Textarea, Number, Email, Phone, Dropdown, Radio, Checkbox, Date, File Upload, Title, Description, New Line, Page Break, Hidden, State, City, State & City
- **Field Configuration** — Edit label, placeholder, CSS class, required toggle, min/max characters, and default value per field
- **Reorder Fields** — Move fields up or down using chevron buttons
- **Duplicate Field** — Clone any field instantly with one click
- **Delete Field** — Remove fields with a confirmation prompt to prevent accidents
- **JSON Export** — View the complete form schema as formatted JSON in a modal
- **Copy JSON** — Copy the JSON output to clipboard with one click
- **LocalStorage Persistence** — Form state is automatically saved; refreshing the page restores your last session
- **Live Field Counter** — Header shows the current number of fields in real time
- **Toast Notifications** — Visual feedback for add, duplicate, delete, and copy actions
- **Responsive Layout** — Stacks to single column at 1024px and below

---

## Setup

```bash
# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Install JS dependencies
npm install

# Start the development server
php artisan serve
```

Visit `http://127.0.0.1:8000` in your browser.

---

## How to Use

1. Type a form title in the input at the top
2. Drag any field from the right panel onto the canvas
3. Click the **pencil icon** on a field card to open Field Options
4. Configure label, placeholder, required, and other settings
5. Click **View JSON** to see the generated schema
6. Click **Copy JSON** to copy it to your clipboard

---

## Assumptions

- **State** and **City** fields use static option values (Gujarat, Maharashtra / Ahmedabad, Rajkot) as placeholders for a real location API
- **State & City** combined field renders two side-by-side dropdowns
- JSON is exported client-side via modal — no backend persistence is implemented
- LocalStorage key is `formBuilder_v1`; clearing browser data will reset the saved form

---

## Sample JSON Output

```json
{
  "title": "Contact Us",
  "fields": [
    {
      "id": 1718123456789,
      "type": "text",
      "label": "Full Name",
      "placeholder": "Enter your name",
      "cssClass": "",
      "required": true,
      "min": "",
      "max": "",
      "defaultValue": ""
    },
    {
      "id": 1718123456790,
      "type": "email",
      "label": "Email Input",
      "placeholder": "Enter your email",
      "cssClass": "",
      "required": true,
      "min": "",
      "max": "",
      "defaultValue": ""
    },
    {
      "id": 1718123456791,
      "type": "dropdown",
      "label": "Dropdown",
      "placeholder": "",
      "cssClass": "",
      "required": false,
      "options": ["Option 1", "Option 2"],
      "min": "",
      "max": "",
      "defaultValue": ""
    }
  ]
}
```

---

## Tech Stack

- **Backend** — Laravel (PHP)
- **Frontend** — Vanilla JavaScript, Bootstrap 5, Bootstrap Icons
- **Storage** — Browser LocalStorage (client-side persistence)
