# Capital Sage Test

This project focuses on individual security and incorporates BVN (Bank Verification Number) verification. It provides an API and Web Interface for performing various security-related tasks.

## Installation

To get started with the project, follow these steps:

1. Clone the repository:

git clone https://github.com/hussayn-dev/Capital-sage-Test.git

2. Install dependencies using Composer:

``` composer install ```


3. Create an environment file (.env) and configure the necessary variables, including the database settings.



4. Generate an application key:

``` php artisan key:generate ```


5. Run database migrations:

```php artisan migrate```

6. Add the following constants to your `.env` file:
```
YOU_VERIFY_BASE_URL = "https://you-verify-api.com"
YOU_VERIFY_APIKEY = "your-you-verify-api-key"

BULK_SMS_NIGERIA_BASE_URL = "https://bulksmsnigeria-api.com"

BULK_SMS_NIGERIA_API_TOKEN = "your-bulksmsnigeria-api-token"
BULK_SMS_NIGERIA_SENDER_ID = "your-sender-id"

```


Start the development server:
The project will run on http://127.0.0.1:8000/.



# Getting Started

## Web Interface
The homepage of the project's web interface provides an overview and guides you through the available functionalities.

Access the web interface at: http://127.0.0.1:8000/

## API Requests
API requests can be made using the provided endpoints. Refer to the Postman documentation for detailed information and usage examples. The documentation can be accessed on the folder BVN Verification API.postman_collection.json
then you can import.

## Project Overview
This project aims to enhance individual security by integrating BVN verification. It incorporates the "You Verify" service, which provides robust BVN verification capabilities. The service has been seamlessly integrated into both the API requests and the web interface.

## Core Functionality
The core functionality of the project is centered around BVN registration and verification. The initial implementation only provided a single function for BVN registration, which was considered less secure due to the ability to test for users as long as the "isSubjectConsent" parameter was set to true. To address this limitation, a secure workflow was designed and implemented. This workflow involves sending an OTP (One-Time Password) to the user's mobile number, which is obtained from the You Verify API response. The user is then required to enter the OTP for successful verification. In the test environment, a default OTP (555555) is used, and the logic for generating different OTPs has been commented out.

## Test Environment
In the test environment, there are certain limitations that should be noted. The default OTP used for testing is 555555. Additionally, the BVN number used for testing purposes is 11111111111.

## Service Integration
To facilitate BVN verification and enhance security, a custom service was developed within the project. This service handles the integration with the You Verify API and provides the necessary functionalities for BVN registration and verification. Both the API requests and the web interface leverage this service to ensure consistent and secure BVN operations.

## Packages Used
Several packages were utilized in the project:

### Sanctum: 
Used for user authentication.
### Livewire: 
Enhanced the project's flow and user experience.
### Spatie Enums: 
Enabled the use of enumerations.
### Redis:
Employed for efficient caching.

## Project Timeline
#### Project Kickoff: Monday afternoon
#### Email Confirmation Received: Monday morning
#### Submission: Wednesday Afternoon

## Acknowledgments
I thoroughly enjoyed working on this project, which provided valuable experience in integrating third-party APIs and developing secure systems. It allowed me to explore new technologies and improve my skills in web development.
>>>>>>> origin/main
