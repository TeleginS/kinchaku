###1
> How long did you spend on the coding test? 
> What would you add to your solution if you had more time? 
> If you didn't spend much time on the coding test then use this as an opportunity to explain what you would add.

7-8 hours spent

- It would be nice to add a test environment so that the tests do not affect the developer database
- Logging (Sentry, etc.)
- Authorization via JWT
- Upgrade php to 8.0 version, better to 8.1 =)
- GraphQL
- Change prettier for php to cs-fixer

### 2 How would you track down a performance issue in production? Have you ever had to do this?
I have little experience with this. 

I would enter logging, SMS notification (AWS can do this), connected a third-party domain response monitoring service(pingdom.com for example)

### 3 Please describe yourself using JSON.
```
{
    "name": "Sergei",
    "lastname": "Telegin",
    "dob": 611697600,
    "nationality": "Russian",
    "city": "Vladivostok",
    "timezone_of_residence": "GMT+10",
        "passions": [
        "Footbal",
        "My family"
    ],
    "interests": [
        "Stock Exchange",
        "Math"
    ],
    "preferred_opening_hours": {
        "start": "09:00:00"
        "end": "18:00:00"
    },
    "expected_salary": {
        "amount": 4200,
        "currency": "USD"
    }
}
```
