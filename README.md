### Overview of the application
This application is a microservice based application, developed using DDD.
It has two services, namely:
- User service which is the publisher.
- Notification service which is the consumer.

RabbitMQ was used for exchange of messages.

Data being transmitted from user service is consumed and saved in a log file on the notification service.

### Architecture of the application

Attached below is a pictorial architecture of the application:

## Proposed Architecture

![architecture](microservice-architecture.png)

### General installation guides

#### Step 1: Clone the repository

```shell
git clone https://github.com/ayodeleoniosun/next-basket.git
```

#### Step 2: Switch to the repo folder

```shell
cd next-basket
```

#### Step 3: Dockerize app

```shell
bash setup.sh
```

#### Step 4: Run migrations on user service

```shell
docker-compose exec user_app php artisan migrate
```

#### Step 5: Create a new terminal and run the queue worker for user service

```shell
docker-compose exec user_app php artisan queue:work
```

#### Step 6: Create a new terminal and consume jobs on notification service

```shell
 docker-compose exec notification_app php artisan rabbitmq:consume
```

#### Step 7: Testing
Run the following command to run tests:

```shell
bash run-tests.sh
```

### API Documentation

The Postman API collection is available [Here](postman_collection.json). <br/>