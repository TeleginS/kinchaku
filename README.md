# kinchaku-test-fullstack-developer App
First launch app(this option clear all containers and drop database with data if exist):
> make init

After app launched you can go to [Upload page(http://localhost:8080/upload/)](http://localhost:8080/upload/) and provide you json file with categories

Start app:
> make up

Stop app:
> make down

Restart app:
> make restart


#Dev tools:
For launch api checks like (psalm, lint, tests) you can use:
> make api-check

Or using it separate:
> make api-psalm
>
> make api-lint
> 
> make tests
> 

Code stile fix:
>
> make code-style-app
> 

or separate:
>
> make api-prettier
> 
> make frontend-prettier
> 

