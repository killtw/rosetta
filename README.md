# Rosetta

## Endpoints

### Create new merchant
* method: POST
* url: /merchants
* POST data:
```json
{
    "name": "string",
    "phone": "string",
    "identity": "string",
    "location": {
        "lat": "float",
        "lng": "float"
    },
    "address": "string"
}
```
* Response
```json
{
    "message": "success",
    "data": {
        "id": "int",
        "name": "string",
        "location": {
            "lat": "float",
            "lng": "float"
        }
    }
}
```
* Example

`POST /merchants`
```json
{
    "name": "test merchant",
    "phone": "0987654321",
    "identity": "A123456789",
    "location": {
        "lat": 25.0375459767136519,
        "lng": 121.56224280595779419
    }
}
```
`Response`
```json
{
    "message": "success",
    "data": {
        "id": 1,
        "name": "test merchant",
        "location": {
            "lat": 25.0375459767136519,
            "lng": 121.56224280595779419
        }
    }
}
```

* Error example

`POST /merchants`
```json
{
    "name": "test merchant",
    "phone": "0987654321",
    "identity": "A123456789",
    "location": {
        "lat": 25.0375459767136519,
        "lng": 121.56224280595779419
    }
}
```
`Response`
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "identity": [
            "identity 不是合法的身分證字號"
        ]
    }
}
```

---

### Create new record
* method: POST
* url: /records
* POST data:
```json
{
    "time": "string",
    "from": "string",
    "text": "string"
}
```
* Response
```json
{
    "message": "success"
}
```
* Example

`POST /records`
```json
{
    "time": "2021-01-01T00:00:00",
    "from": "0987654321",
    "text": "場所代碼：1111 1111 1111 111\n本簡訊是簡訊實聯制發送，限防疫目的使用"
}
```
`Response`
```json
{
    "message": "success"
}
```

* Error example

`POST /records`
```json
{
    "time": "2021-01-01T00:00:00",
    "from": "0987654321",
    "text": "場所代碼：1111 1111 111\n本簡訊是簡訊實聯制發送，限防疫目的使用"
}
```
`Response`
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "from": [
            "text 沒有包含場所代碼"
        ]
    }
}
```

---

### Search records
* method: POST
* url: /records/search
* POST data:
```json
{
    "merchant": "string",
    "time": "date string"
}
```
* Response
```json
{
    "message": "success",
    "data": [
        {
            "from": "string",
            "time": "datetime string"
        }
    ]
}
```
* Example

`POST /records/search`
```json
{
    "merchant": "111111111111111",
    "time": "2021-01-01T00:00:00"
}
```
`Response`
```json
{
    "message": "success",
    "data": [
        {
            "from": "0987654321",
            "time": "2021-09-01T07:19:56.000000Z"
        },
        {
            "from": "0961350572",
            "time": "2021-09-01T08:19:56.000000Z"
        },
        {
            "from": "0978906265",
            "time": "2021-09-01T09:19:56.000000Z"
        }
    ]
}
```

* Error example

`POST /merchants`
```json
{
    "merchant": "11111",
    "time": "2021-01-01T00:00:00"
}
```
`Response`
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "identity": [
            "merchant 包含的場所代碼不存在"
        ]
    }
}
```
