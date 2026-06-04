 **API CONTRACT**

**Format respon**

    Success
    {
        "success": true,
        "message": "Berhasil",
        "data": {}
    }
    Error
    {
        "success": false,
        "message": "Terjadi kesalahan"
    }


**1. Authentication**
**Login**
Endpoint    |   POST /login

**Halaman Login**
    {
        "email": "admin@robotika.com",
        "password": "password123"
    }

**Login Berhasil**
    {
    "success": true,
    "message": "Login berhasil",
    "data": {
        "token": "xxxxxx",
        "id_user": 1,
        "name": "Shafa",
        "email": "shafa@gmail.com",
        "roles": [
            "ketua_tim",
            "anggota_tim"
        ]
    }
}

**Error Respon**
    { 
    "success": false, 
    "message": "Email atau password salah"
    }

**Request**
Endpoint    |   POST /switch-role

    {
    "role": "ketua_tim"
    }

**Respon Request**

    {
    "success": true,
    "message": "Role berhasil diubah",
    "data": {
        "active_role": "ketua_tim"
        }
    }

**Logout**
Endpoint    |   POST /logout    | Authorization : Bearer {token}

**Profile**
Endpoint    |   GET /profile    | Authorization : Bearer {token}

    {
    "id_user": 1,
    "name": "Shafa",
    "email": "shafa@gmail.com",
    "roles": [
        "ketua_tim",
        "anggota_tim"
    ],
    "active_role": "ketua_tim"
    }


**2. User management**

**Create User**
Endpoint    |   POST /users

**Role**

Request Body
{
    "name": "Shafa",
    "email": "shafa@gmail.com",
    "password": "password123",
    "roles": [
        "anggota_tim",
        "ketua_tim"
    ]
}

**Get User Roles**
Endpoint    |   GET /users/{id_user}/roles

**Get All Users**
Endpoint    |   GET /users

**Get User Detail**
Endpoint    |   GET /users/{id_users}

**Update User**
Endpoint    |   PUT /users/{id_users}

**Delate User**
Endpoint    |   DELETE /users/{id_users}

**3. Task management**

**Create Task**
Endpoint    |   POST /tasks

    { 
        "title": "Bab-1 Membuat Sensor", 
        "description": "Membuat modul sensor ultrasonik", 
        "assigned_to": 5, 
        "deadline": "2026-06-15 23:59:59" 
        }


    {
    "title": "Bab-1 Membuat Sensor",
    "description": "Membuat modul sensor ultrasonik",
    "assigned_to": [5, 7, 10],
    "deadline": "2026-06-15 23:59:59"
}

**Get Task**
Endpoint    |   GET /tasks

**Get Task Detail**
Endpoint    |   GET /tasks/{id_task}

**Update Task Detail**
Endpoint    |   UPDATE /tasks/{id_task}

**Delete Task Detail**
Endpoint    |   DELETE /tasks/{id_task}

**4. Task Progress**

**Add Progress**
Endpoint    |   POST /tasks-progress

    { 
    "task_id": 1, 
    "notes": "Progress pengerjaan sensor", 
    "percentage": 50 }



//ambil persenannya bagaimana?


**5. Material Management**

**Create Material**
Endpoint    |   POST /materials

**Upload Material File**
Endpoint    |   POST /materials/{id_material}/files

**Get Materials**
Endpoint    |   GET /materials

**Get Material Detail**
Endpoint    |   GET /materials/{id_material}

**Download Materials**
Endpoint    |   GET /material-files/{id_file}/download

**Update Material**
Endpoint    |   PUT /materials/{id_material}

**Delete Material**
Endpoint    |   DELETE /materials/{id_material}

**6. Chatbot**

**Create Session**
Endpoint    |   POST /chatbot/session

**Send Message**
Endpoint    |   POST /chatbot/{sessin_id}//message

**Get Chat History**
Endpoint    |   GET /chatbot/session/{session_id}

**7. Team Management**

**Create Team**
Endpoint    |   POST /teams

**Request**
    {
    "team_name": "Tim Robo-line",
    "ketua_team_id": 3
    }

**Respon**
    {
    "success": true,
    "message": "Tim berhasil dibuat",
    "data": {
        "id_team": 1,
        "team_name": "Tim KRSTI",
        "ketua_team_id": 3
        }
    }

**Get All Teams**
Endpoint    |   POST /teams

    {
    "success": true,
    "message": "Data tim berhasil diambil",
    "data": [
        {
            "id_team": 1,
            "team_name": "Tim KRSTI",
            "ketua_team_id": 3
        },
        {
            "id_team": 2,
            "team_name": "Tim KRSBI",
            "ketua_team_id": 5
            }
        ]
    }

**Add Team Member**
Endpoint    |   POST /teams/{id_team}/members

    {
    "anggota_id": 3
    }

**Add Team Detail**
Endpoint    |   GET /teams/{id_team}

**Update Team**
Endpoint    |   PUT /teams/{id_team}

**Delete Team**
Endpoint    |   DELETE /teams/{id_team}

**Get Team Members**
Endpoint    |   GET /teams/{id_team}/members

    {
    "success": true,
    "message": "Data anggota tim",
    "data": [
        {
            "id_user": 7,
            "name": "Andre"
        },
        {
            "id_user": 8,
            "name": "Rafli"
            }
        ]
    }

**Remove Team Member**
Endpoint    |   DELETE /teams/{id_team}/members/{id_user}


**8. Division Management**

**Create Division**
Endpoint    |   GET /divisions

**Update Divisions**
Endpoint    |   UPDATE /divisions/{id_division}

**Get Divisions**
Endpoint    |   GET /divisions

**Delete Division**
Endpoint    |   DELETE /divisions/{id_division}

**Add Division Member**
Endpoint    |   POST /divisions/{id_division}/members
