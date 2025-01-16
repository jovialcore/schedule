![tests reuslts](image-1.png)

## Project Structure Summary

- We have a **controller** to prepare data for the client and a **service class** to encapsulate our logic.
- Feature tests have been written to cover all necessary cases.
- Frontend data is wrapped using **resource classes**.

---

## Running the Project

1. Run `composer install` to set up dependencies.
2. Test cases are located at `tests/Feature/RegisterEventTest.php`. To verify functionality, run:
   ```bash
   php artisan test

