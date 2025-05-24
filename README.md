# Barangay Transaction Portal

A web-based application for managing barangay transactions, records, and resident information.

## Features

- Resident registration and management
- Barangay clearance and certificate requests
- Transaction tracking and history
- User authentication and roles (Admin, Staff, Resident)
- Reports generation

## Technologies Used

- PHP (XAMPP/LAMPP stack)
- MySQL/MariaDB
- HTML, CSS, JavaScript

## Installation

1. Clone or download the repository to your XAMPP/LAMPP `htdocs` directory.
2. Import the provided SQL database into your MySQL server.
3. Update database credentials in the configuration files if necessary.
4. Start Apache and MySQL services.
5. Access the application via `http://localhost/brgy_tx_prot/`.

## Usage

- Login as Admin, Staff, or Resident.
- Manage residents, process requests, and generate reports as needed.

## Contributing

Pull requests are welcome. For major changes, please open an issue first.

## License

This project is licensed under the MIT License.

## Project Structure
```
brgy_tx_prot/
│
├── index.php
├── README.md
│
├── config/
│   └── (configuration files)
│
├── public/
│   ├── css/
│   │   └── shared-styles.css
│   ├── images/
│   │   ├── barangay.svg
│   │   └── brgy-bg.jpg
│   └── js/
│       └── clock.js
│
├── src/
│   ├── controllers/
│   └── models/
│
└── templates/
    ├── main.php
    └── partials/
        ├── footer.php
        ├── header.php
        └── navbar.php
```