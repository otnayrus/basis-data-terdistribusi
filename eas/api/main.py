from flask import Flask, jsonify, request
import mysql.connector
import json

DB_HOST = '192.168.16.64'
DB_PORT = 4000
DB_USER = 'root'
DB_PASS = ''
DB_NAME = 'food_catalogue'

app = Flask(__name__)
app.secret_key = "simple_food_api"
app.config['MYSQL_HOST'] = DB_HOST
app.config['MYSQL_PORT'] = DB_PORT
app.config['MYSQL_USER'] = DB_USER
app.config['MYSQL_PASSWORD'] = DB_PASS
app.config['MYSQL_DB'] = DB_NAME

db = mysql.connector.connect(
  host=DB_HOST,
  port=DB_PORT,
  user=DB_USER,
  passwd=DB_PASS,
  database=DB_NAME
)


@app.route('/foods', methods=['GET'])
def catalogue():
    cursor = db.cursor()
    
    cursor.execute("SELECT * FROM catalogue")

    datas = []
    for (id, dish_name, rating, prep_time, calories, description) in cursor:
        data = {}
        data['id'] = id
        data['dish_name'] = dish_name
        data['rating'] = rating
        data['prep_time'] = prep_time
        data['calories'] = calories 
        data['description'] = description
        datas.append(data)

    cursor.close()
    res = json.dumps(datas)
    return res


@app.route('/foods', methods=['POST'])
def create():
    request_json = request.json
    dish_name = request_json["dish_name"]
    rating = request_json["rating"]
    prep_time = request_json["prep_time"]
    calories = request_json["calories"]
    description = request_json["description"]

    cursor = db.cursor()
    cursor.execute("INSERT INTO catalogue (`dish_name`, `rating`, `prep_time`, `calories`, `description`) VALUES (%s, %s, %s, %s, %s);", (dish_name, rating, prep_time, calories, description))
    db.commit()
    cursor.close()

    res = jsonify('Added '+dish_name+' data to catalogue!')
    res.status_code = 200
    return res


@app.route('/foods',methods=['PUT'])
def update():
    request_json = request.json
    id = request_json["id"]
    rating = request_json["rating"]

    cursor = db.cursor()
    cursor.execute("UPDATE catalogue SET rating = %s WHERE id = %s", (rating, id))
    db.commit()
    cursor.close()

    res = jsonify('Changed rating on catalogue!')
    res.status_code = 200
    return res


@app.route('/foods', methods=['DELETE'])
def delete():
    request_json = request.json
    id = request_json["id"]

    cursor = db.cursor()
    cursor.execute("DELETE FROM catalogue WHERE id = "+str(id))
    db.commit()
    cursor.close()

    res = jsonify('Food data deleted!')
    res.status_code = 200
    return res


if __name__ == "__main__":
    app.run()
