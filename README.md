# Tourism Booking Management Project

## Introduction

Welcome to the tourism booking management project. This project aims to assess your ability to develop and improve an existing Laravel application. Below, you will find the necessary enhancements and new functionalities you are expected to implement. Additionally, we have listed some appreciated features that can add value to your solution.

We hope this project allows you to demonstrate your technical skills and your ability to write clean, efficient, and well-structured code. If you have any questions or need further clarification, please feel free to ask. Good luck!

## Requested Features

1. **Send an Email to the User with Booking Information at the Time of Creation (Mail + Blade):**
   - The email should include the client's name, tour name, hotel name, booking date, and number of people.
2. **Allow Searches by Tour Name, Hotel Name, or Client Name.**
3. **Allow Searches by Date Range.**
4. **Allow Data Sorting, Both Ascending and Descending.**
5. **Create an Endpoint `/api/bookings/export` that Generates a CSV File with All Bookings:**
   - The use of the `laravel-excel` library is recommended.
6. **Add Pagination to the Listings of Tour, Hotel, and Booking.**
7. **Add Statuses to Bookings and Create an Endpoint `/api/bookings/{id}/cancel` that Changes the Booking Status to Canceled.**

## Appreciated Features

1. **Generation of Tests:** Create tests to verify the new features and improve existing ones.
2. **Use of Eloquent Resources:** Utilize Eloquent Resources for data transformation.
3. **Use of Eloquent Scopes:** Utilize Eloquent Scopes for data searches.
4. **Use of Eloquent Events:** Utilize Eloquent Events for sending emails.
5. **Use of Jobs:** Utilize Jobs for CSV file generation.
6. **Use of FormRequests:** Utilize FormRequests for data validation.
7. **Use of Traits:** Utilize Traits for code reuse where necessary.
8. **Use of Enums:** Utilize Enums to improve code readability where possible.

## Usage
Once the project is cloned, set up the .env file for local development and an optional .env.testing file for testing. 

Install the necessary dependencies, example:
```bash 
   php artisan key:generate
```
to generate the APP_KEY in your .env file

We raise the containers
```bash
   docker compose up -d --build .\vendor\bin\sail up -d
```
**OR**
```bash
   .\vendor\bin\sail up -d
```

Once the project is running we execute the migrations in case they have not been executed with:
```bash 
   php artisan migrate -> local execution
```
```bash
   docker compose exec {container_name} php artisan migrate -> container level execution
```

**Optional:**
We run the seeders to insert dummy data into the Tour and Hotel tables.
```bash
   php artisan db:seed
   docker compose exec {container_name} php artisan db:seed
```

Examples of usage mode:
JSON to insert a booking:
```bash
{
   "tour_id": 1,
   "hotel_id": 1,
   "customer_name": "Persona Test",
   "customer_email": "test@test.com",
   "number_of_people": 2,
   "booking_date": "2024-07-20"
}
```

JSON for response:
```bash
{
    "tour_id": 1,
    "hotel_id": 1,
    "customer_name": "Persona Test",
    "customer_email": "test@test.com",
    "number_of_people": 2,
    "booking_date": "2024-07-20",
    "updated_at": "2024-07-22T23:23:47.000000Z",
    "created_at": "2024-07-22T23:23:47.000000Z",
    "id": 1,
    "tour": {
        "id": 1,
        "name": "In enim commodi perspiciatis quos velit est et.",
        "description": "Dolor molestias est tenetur corrupti repellat dolorem. Cupiditate facilis qui qui quibusdam id est sit ab. Ut sit in reiciendis non possimus et facere. Voluptatem amet itaque quae omnis. Nam nulla eos est mollitia amet ex.",
        "price": "727.17",
        "start_date": "1979-06-17",
        "end_date": "2024-09-07",
        "created_at": "2024-07-22T22:41:32.000000Z",
        "updated_at": "2024-07-22T22:41:32.000000Z"
    },
    "hotel": {
        "id": 1,
        "name": "Muller Ltd",
        "description": "Et doloribus nihil iste. Harum nesciunt adipisci voluptas provident nobis. Fuga officia ut in voluptate et ipsum.",
        "address": "24170 Katelin Fields Suite 658\nSouth Kolby, NC 46836",
        "rating": 3,
        "price_per_night": "468.49",
        "created_at": "2024-07-22T22:41:33.000000Z",
        "updated_at": "2024-07-22T22:41:33.000000Z"
    }
}
```

Response JSON with list of reservations:
```bash
{
   "data": [
      {
            "id": 1,
            "tour_id": 1,
            "hotel_id": 1,
            "customer_name": "Persona Test",
            "customer_email": "test@test.com",
            "number_of_people": 2,
            "booking_date": "2024-07-20",
            "created_at": "2024-07-22T22:42:30.000000Z",
            "updated_at": "2024-07-22T22:42:30.000000Z"
      },
      {
            "id": 2,
            "tour_id": 55,
            "hotel_id": 113,
            "customer_name": "Persona Test2",
            "customer_email": "test@test.com",
            "number_of_people": 2,
            "booking_date": "2024-07-20",
            "created_at": "2024-07-22T22:42:46.000000Z",
            "updated_at": "2024-07-22T22:42:46.000000Z"
      },
      {
            "id": 3,
            "tour_id": 55,
            "hotel_id": 113,
            "customer_name": "Persona Test",
            "customer_email": "test@test.com",
            "number_of_people": 2,
            "booking_date": "2024-07-20",
            "created_at": "2024-07-22T22:42:52.000000Z",
            "updated_at": "2024-07-22T22:42:52.000000Z"
      },
      {
            "id": 4,
            "tour_id": 96,
            "hotel_id": 109,
            "customer_name": "Persona Test",
            "customer_email": "test@test.com",
            "number_of_people": 2,
            "booking_date": "2024-07-20",
            "created_at": "2024-07-22T22:43:06.000000Z",
            "updated_at": "2024-07-22T22:43:06.000000Z"
      },
      {
            "id": 5,
            "tour_id": 96,
            "hotel_id": 109,
            "customer_name": "Persona Test5",
            "customer_email": "test@test.com",
            "number_of_people": 2,
            "booking_date": "2024-07-29",
            "created_at": "2024-07-22T22:44:32.000000Z",
            "updated_at": "2024-07-22T22:55:29.000000Z"
      },
      {
            "id": 6,
            "tour_id": 81,
            "hotel_id": 105,
            "customer_name": "Persona Test",
            "customer_email": "test@test.com",
            "number_of_people": 2,
            "booking_date": "2024-07-20",
            "created_at": "2024-07-22T23:23:47.000000Z",
            "updated_at": "2024-07-22T23:23:47.000000Z"
      }
   ],
   "links": {
      "first": "http://localhost/api/bookings?page=1",
      "last": "http://localhost/api/bookings?page=1",
      "prev": null,
      "next": null
   },
   "meta": {
      "current_page": 1,
      "from": 1,
      "last_page": 1,
      "links": [
            {
               "url": null,
               "label": "&laquo; Previous",
               "active": false
            },
            {
               "url": "http://localhost/api/bookings?page=1",
               "label": "1",
               "active": true
            },
            {
               "url": null,
               "label": "Next &raquo;",
               "active": false
            }
      ],
      "path": "http://localhost/api/bookings",
      "per_page": 20,
      "to": 6,
      "total": 6
   }
}
```

JSON response JSON with filtered reservation list:
**example to: /api/bookings?start_date=2024-07-29&end_date=2024-07-29**
```bash
{
   "data": [
      {
         "id": 23,
         "tour_id": 96,
         "hotel_id": 109,
         "customer_name": "Persona Test5",
         "customer_email": "test@test.com",
         "number_of_people": 2,
         "booking_date": "2024-07-29",
         "created_at": "2024-07-22T22:44:32.000000Z",
         "updated_at": "2024-07-22T22:55:29.000000Z"
      }
   ],
   "links": {
      "first": "http://localhost/api/bookings?page=1",
      "last": "http://localhost/api/bookings?page=1",
      "prev": null,
      "next": null
   },
   "meta": {
      "current_page": 1,
      "from": 1,
      "last_page": 1,
      "links": [
         {
               "url": null,
               "label": "&laquo; Previous",
               "active": false
         },
         {
               "url": "http://localhost/api/bookings?page=1",
               "label": "1",
               "active": true
         },
         {
               "url": null,
               "label": "Next &raquo;",
               "active": false
         }
      ],
      "path": "http://localhost/api/bookings",
      "per_page": 20,
      "to": 1,
      "total": 1
   }
}
```

**See more in the postman collection in this link: https://drive.google.com/file/d/1oaOBsnJ-4_IIKE68n3YzEj4q6nWRrIk-/view?usp=sharing**🚀🚀