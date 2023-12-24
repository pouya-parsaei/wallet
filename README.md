# Project Setup

While it is possible to run this project without Docker and Laravel Sail, for convenience, it is recommended to use Laravel Sail to set up the project.

## Step 1: Clone the Repository

Clone the repository using the following [link](https://github.com/pouya-parsaei/wallet).

## Step 2: Install Dependencies

Navigate to the project directory and execute the following command:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

## Step 3: Configure Environment Variables

Add a `.env` file to the project directory and set the necessary environment variables.

## Step 4: Run the Application

After aliasing `vendor/bin/sail` to `sail`, you can use the following commands to start the application:

```bash
sail up -d

sail artisan migrate
```

### Tip: Insert Dummy Data

If you wish to populate your database with dummy data, run the following command:

```bash
sail artisan db:seed --class=Database\\Seeders\\Fake\\FakeDataSeeder
```

These steps will ensure a smooth setup for your project. If you have any questions or encounter issues, feel free to reach out.


---

# Project APIs

This project provides the following APIs for managing user wallets:

## Postman Collection

To simplify the testing of these APIs, a Postman collection has been provided. You can find the collection file named `wallet.postman_collection.json` at the project's root. Import this collection into your Postman workspace to easily send requests and explore the functionalities of the project's APIs.

## Running the Postman Collection

1. Download and install [Postman](https://www.postman.com/downloads/).
2. Import the `wallet.postman_collection.json` file into Postman.
3. Use the imported collection to send requests to the project's APIs and streamline the testing process.

Feel free to customize the base API URL according to your environment. If you have any questions or need further assistance, don't hesitate to ask.


## 1. Get Wallet Balance

### Endpoint
```
GET /wallets/get-balance
```

### Request
- **user_id** (Required): Integer, representing the user's ID.

**Example Request:**
```bash
curl -X GET \
  'http://your-api-base-url/wallets/get-balance?user_id=123' \
  -H 'Accept: application/json'
```

### Response
- **balance**: Current wallet balance for the specified user.

**Example Response:**
```json
{
  "balance": 100.00
}
```

## 2. Add Money to Wallet

### Endpoint
```
POST /wallets/add-money
```

### Request
- **user_id** (Required): Integer, representing the user's ID.
- **amount** (Required): Integer, representing the amount to add to the wallet. Should be within the range of -999999999999 to 999999999999.

**Example Request:**
```bash
curl -X POST \
  'http://your-api-base-url/wallets/add-money' \
  -H 'Accept: application/json' \
  -H 'Content-Type: application/json' \
  -d '{
    "user_id": 123,
    "amount": 50
  }'
```

### Response
- **reference_id**: Unique identifier for the transaction.

**Example Response:**
```json
{
  "reference_id": "abc123"
}
```

---

# Daily Job: Calculate Total Amount of Transactions

To ensure accurate and up-to-date information on the total amount of transactions in the system, a daily job has been implemented. This job calculates the sum of transaction amounts and prints the result to the terminal. This provides a quick overview of the overall transaction activity within the specified time frame.

## Usage

To run the job manually, execute the following artisan command in your terminal:

```bash
php artisan transactions:total-amount
```

This will display the total amount of transactions on the terminal.

## Scheduled Daily Job

The daily job is also scheduled to run automatically every day. The scheduling configuration is located in the `App\Console\Kernel` class. The job is set to run daily using the following schedule:

```php
protected function schedule(Schedule $schedule): void
{
    $schedule->command('transactions:total-amount')->daily();
}
```

This ensures that the total amount of transactions is calculated and printed to the terminal on a daily basis, providing a consistent overview of transaction activity.

Feel free to customize the scheduling frequency or the artisan command based on your project's specific requirements.

If you have any questions or need further assistance, please don't hesitate to reach out.

---

# Running Tests

To ensure the stability and correctness of the project, you can run the tests using the following artisan command:

```bash
sail artisan test
```

This command initiates the testing suite and executes all the tests defined in the project. The output will provide information about the number of tests run, assertions made, and any failures encountered.

Make sure your environment is set up correctly with Docker and Laravel Sail before running the tests.

Feel free to explore additional options and flags for the `test` command to customize the testing process according to your needs. If you encounter any issues or have questions, don't hesitate to reach out for assistance.
