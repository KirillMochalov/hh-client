# Simple HH client  
API-клиент сервиса hh.ru на php.  

## Установка  
В файле composer.json добавить репозиторий и имя пакета:
```
"repositories": [
    ...
    {
        "type": "vcs",
        "url": "https://github.com/KirillMochalov/hh-client"
    }
],
"require": {
    ...
    "simple-hh-client/client": "dev-master"
}
```
Выполнить команду:  
```
composer install
```

## Авторизация  
Для выполнения любого запроса к hh.ru нужно получить токен соискателя/приложения. Для получение токена соискателя создаем объект класса OAuthClient и вызываем метод getAuthenticationUrl, который вернет url для редиректа пользователя. 
```
$oauth_client = new OAuthClient('%client_id%', '%client_secret%', 'http://localhost/hh');
$redirect_url = $oauth_client->getAuthenticationUrl();
```  
После авторизации на сайте hh.ru пользователь будет перенаправлен по адресу, указанному в качестве третьего параметра в конструкторе OAuthClient. В примере это http://localhost/hh.  
На странице http://localhost/hh создаем объект класса OAuthClient и вызываем метод oAuth с GET-параметром code.
```
$oauth_client = new OAuthClient('%client_id%', '%client_secret%', 'http://localhost/hh');
$access_token = $oauth_client->oAuth($_GET['code'])->getAccessToken();
```
Полученный токен нужно сохранить в сессии или БД для дальнейшего использования.  

## Использование клиента соискателя  
Объект класса ApplicantClient создается с использованием ранее полученного токена соискателя.
```
$hh_client = new ApplicantClient($access_token);
```
### Поиск вакансий
```
$search_string = 'Кассир';
$vacancies = $hh_client->searchVacancies($search_string);
```
### Получение подробных сведений о вакансии  
```
$vacancy_id = 48759683;
$vacancy = $hh_client->getVacancy($vacancy_id);
```
### Список резюме соискателя
```
$resumes = $hh_client->getResumes();
```  
### Получение подробных сведений о резюме
```
$resume_id = '77ea924eff03bff13a0039ed1f465361344953';
$resume = $hh_client->getResume($resume_id);
```
### Обновление резюме
```
$resume_id = '77ea924eff03bff13a0039ed1f465361344953';
$resume = $hh_client->getResume($resume_id);
$resume['last_name'] = 'Иванов';
$hh_client->updateResume($resume_id, $resume);
```
### Размещение резюме
Для размещения нового резюме нужно создать объект класса Resume и заполнить обязательные поля. Далее передать объект в метод createResume базового клиента.
```
$resume = new Resume();
$resume->setFirstName('Иван');
$resume->setLastName('Иванов');
$resume->setTitle('Кассир');
$resume->setArea([
    'id' => '4',
    'name' => 'Новосибирск',
    'url' => 'https://api.hh.ru/areas/4',
]);
$resume->setGender([
    'id' => 'male',
    'name' => 'Мужской',
]);
$resume->setResumeLocale([
    'id' => 'RU',
    'name' => 'Русский',
]);
$resume->setCitizenship([
    [
        'id' => '113',
        'name' => 'Россия',
        'url' => 'https://api.hh.ru/areas/113',
    ]
]);
$resume->setAccess([
    'type' => [
        'id' => 'direct',
        'name' => 'доступно только по прямой ссылке',
    ]
]);
...

$client->createResume($resume);
```
Часть полей заполняется элементами из справочников. Подробнее по ссылке https://github.com/hhru/api/blob/master/docs/resumes.md#create_edit  

### Справочники
Для получения справочников применяется ряд методов класса ApplicantClient.  
getDictionaries - основные справочники;  
getAreas - справочник регионов;  
getSpecializations - справочник специализаций;  
getLanguages - справочник языков;  
getMetros - справочник метро;  
getLocales - справочник локализаций резюме.  

### Дополнительные методы класса ApplicantClient
getNewResumeConditions - условия полей для создания резюме;  
getResumeConditions - условия полей для обновления резюме;  
getApplicantAgreement - соглашение об оказании услуг по содействию в
трудоустройстве;  
deleteResume - удаление резюме;  
publishResume - публикация резюме после создания.  

## ApplicationClient (клиент приложения)
### Получение токена приложения
Для вызова методов класса ApplicationClient нужно получить токен приложения. Токен приложения необходимо сгенерировать 1 раз. В случае, если токен был скомпрометирован, его нужно запросить еще раз. При этом ранее выданный токен отзывается.
```
$application_client = new ApplicationClient('%client_id%', '%client_secret%');
$application_token = $application_client->generateApplicationToken();
```

### Регистрация нового соискателя
Для регистрации пользователей используется класс ApplicationClient. В конструктор нужно передать параметры client_id, client_secret и токен приложения.
```
$application_client = new ApplicationClient('%client_id%', '%client_secret%', '%application_token%');
```
Метод createUser принимает параметры: почтовый адрес (логин), имя, фамилия и отчество (необязательно).
```
$login = 'example@example.com';
$first_name = 'Иван';
$last_name = 'Иванов';
$middle_name = 'Иванович';
$application_client->createUser($login, $first_name, $last_name, $middle_name);
```

## Требования
- php ^7.3|^8.0  
- ext-json *

## Документация HeadHunter API 
https://github.com/hhru/api
