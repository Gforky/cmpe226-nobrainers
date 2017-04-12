from flask import Flask
from flask import render_template, request
from flask_sqlalchemy import SQLAlchemy
from sqlalchemy.orm import sessionmaker
from sqlalchemy import create_engine
from sqlalchemy.ext.declarative import declarative_base
import models
from models import Base, TrainingImageData, UserData, ImageCategories, ClassificationResult, InputImageData
from werkzeug import secure_filename
from flask import json
import os

app = Flask(__name__)
UPLOAD_FOLDER = 'imgFolders/'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER
ALLOWED_FILE_EXTENSIONS = set(['tar', 'zip'])

#web services API
@app.route("/")
def login():
    return render_template('login.html')

@app.route("/index")
def index():
	return render_template('index.html')


@app.route("/upload-files", methods=['GET', 'POST'])
def uploadfile():
	if request.method == 'POST':
		imgFile = request.files['file']
		if imgFile and allowed_file_type(imgFile.filename):
			filename = secure_filename(imgFile.filename)
			imgFile.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))
			return 'sucessfully upload'
	return 'not successfully upload'


@app.route("/getTrainingImageStats", methods=['POST'])
def getImageStats():
    """
    This is function for API of getting image stats

    Returns: json arr [category_1 count, category_2 count, category_3 count, total count]

    ---
    TODO: can use bar chart to show the result
    """
    if request.method == 'POST':
        imagedata_stats_arr = []
        counter, counter1, counter2, counter3 = 0, 0, 0, 0
        for data in session.query(ImageData.category_id == 1).all():
            counter1 += 1
        imagedata_stats_arr.append(counter1)
        for data in session.query(ImageData.category_id == 2).all():
            counter2 += 1
        imagedata_stats_arr.append(counter2)
        for data in session.query(ImageData.category_id == 3).all():
            counter3 += 1

        imagedata_stats_arr.append(counter3)
        counter = counter1 + counter2 + counter3
        imagedata_stats_arr.append(counter)

        json_str = json.dumps(imagedata_stats_arr)
        return json_str

#########################   Image Confirmation  #########################
@app.route("/imgConfirmation", methods=['POST'])
def imgConfirmation():
    '''
    Function to move the images from tempory folder to the new dataset folder
    '''
    try:
        imgInfo = request.get_json()
        print("Current Image Source is " + imgInfo["imgSrc"])
        print(imgInfo["labels"])
        return json.dumps("POST Successfully")
    except Exception:
        return traceback.format_exc()
#########################   Image Confirmation  #########################

#########################   C3 Chart AJAX   #############################
@app.route("/getCpuUsage", methods=['POST'])
def getCpuUsage():
    """
    Function to get the image storage status from the database
    """
    try:
        return json.dumps([
          ['x', '2013-01-07', '2013-01-08', '2013-01-09', '2013-01-10', '2013-01-11', '2013-01-12'],
          ['CPU Usage', 46, 78, 88, 72, 98, 88]
        ])
    except Exception:
        return traceback.format_exc()

@app.route("/getMemLoad", methods=['POST'])
def getMemLoad():
    """
    Function to get the image storage status from the database
    """
    try:
        return json.dumps([
          ['x', '2013-01-07', '2013-01-08', '2013-01-09', '2013-01-10', '2013-01-11', '2013-01-12'],
          ['Memory Load', 46, 78, 88, 72, 98, 88]
        ])
    except Exception:
        return traceback.format_exc()

@app.route("/getNetTraff", methods=['POST'])
def getNetTraff():
    """
    Function to get the image storage status from the database
    """
    try:
        return json.dumps([
          ['x', '2013-01-07', '2013-01-08', '2013-01-09', '2013-01-10', '2013-01-11', '2013-01-12'],
          ['Network Traffic', 100, 120, 130, 150, 120, 135]
        ])
    except Exception:
        return traceback.format_exc()

@app.route("/getCpuTemp", methods=['POST'])
def getCpuTemp():
    """
    Function to get the image storage status from the database
    """
    try:
        return json.dumps([
          ['x', '2013-01-07', '2013-01-08', '2013-01-09', '2013-01-10', '2013-01-11', '2013-01-12'],
          ['CPU Temperature', 46, 50, 65, 72, 78, 54]
        ])
    except Exception:
        return traceback.format_exc()

@app.route("/getImgStorage", methods=['POST'])
def getImgStorage():
    """
    Function to get the image storage status from the database
    """
    try:
        return json.dumps([
            ['mattress', 376], ['couch', 456], ['tv-monitor', 231]
        ])
    except Exception:
        return traceback.format_exc()

@app.route("/getDBIO", methods=['POST'])
def getDBIO():
    """
    Function to get the image storage status from the database
    """
    try:
        return json.dumps([
            ['x', '2013-01-07', '2013-01-08', '2013-01-09', '2013-01-10', '2013-01-11', '2013-01-12'],
            ['Database I/O Traffic', 20, 30, 88, 72, 98, 88]
        ])
    except Exception:
        return traceback.format_exc()

@app.route("/getDBQuery", methods=['POST'])
def getDBQuery():
    """
    Function to get the image storage status from the database
    """
    try:
        return json.dumps([
            ['x', '2013-01-07', '2013-01-08', '2013-01-09', '2013-01-10', '2013-01-11', '2013-01-12'],
            ['Database Queries', 200, 300, 880, 720, 980, 880]
        ])
    except Exception:
        return traceback.format_exc()

@app.route("/getDatasetSize", methods=['POST'])
def getDatasetSize():
    """
    Function to get the image storage status from the database
    """
    try:
        return json.dumps([
            ['x', '2013-01-07', '2013-01-08', '2013-01-09', '2013-01-10', '2013-01-11', '2013-01-12'],
            ['mattress', 176, 180, 188, 190, 192, 196],
            ['couch', 156, 166, 276, 286, 390, 396],
            ['tv-monitor', 55, 167, 173, 285, 389, 197]
        ])
    except Exception:
        return traceback.format_exc()

@app.route("/getImgConf", methods=['POST'])
def getImgConf():
    """
    Function to get the image storage status from the database
    """
    try:
        return json.dumps([
            ['x', '2013-01-07', '2013-01-08', '2013-01-09', '2013-01-10', '2013-01-11', '2013-01-12'],
            ['mattress', 176, 180, 188, 190, 192, 196],
            ['couch', 156, 166, 276, 286, 390, 396],
            ['tv-monitor', 55, 167, 173, 285, 389, 197]
        ])
    except Exception:
        return traceback.format_exc()

@app.route("/getUpImg", methods=['POST'])
def getUpImg():
    """
    Function to get the image storage status from the database
    """
    try:
        return json.dumps([
            ['x', '2013-01-07', '2013-01-08', '2013-01-09', '2013-01-10', '2013-01-11', '2013-01-12'],
            ['mattress', 176, 180, 188, 190, 192, 196],
            ['couch', 156, 166, 276, 286, 390, 396],
            ['tv-monitor', 55, 167, 173, 285, 389, 197]
        ])
    except Exception:
        return traceback.format_exc()

@app.route("/getDetectedObj", methods=['POST'])
def getDetectedObj():
    """
    Function to get the image storage status from the database
    """
    try:
        return json.dumps([
            ['x', '2013-01-07', '2013-01-08', '2013-01-09', '2013-01-10', '2013-01-11', '2013-01-12'],
            ['mattress', 26, 20, 18, 19, 19, 16],
            ['couch', 15, 16, 26, 26, 39, 36],
            ['tv-monitor', 55, 17, 13, 25, 39, 19]
        ])
    except Exception:
        return traceback.format_exc()

@app.route("/getAP", methods=['POST'])
def getAP():
    """
    Function to get the image storage status from the database
    """
    try:
        return json.dumps([
            ['x', '2013-01-07', '2013-01-08', '2013-01-09', '2013-01-10', '2013-01-11', '2013-01-12'],
            ['mattress', 76, 80, 88, 90, 92, 96],
            ['couch', 56, 66, 76, 86, 90, 96],
            ['tv-monitor', 55, 67, 73, 85, 89, 97]
        ])
    except Exception:
        return traceback.format_exc()
#########################   C3 Chart AJAX   #############################

@app.route("/getClassificationStats", methods=['POST'])
def getClassifiactionStats():
    """
    This is function for API of getting classification stats

    Returns:
        json String: [count for category 1, count for category 2,
         count for category 3, count for unkonwn, total image count]

    ---
    TODO: use piechart to show the result
    """
    if request.method == 'POST':
        classfication_stats_arr = []
        counterUnknown, counter1, counter2, counter3, denominator = 0, 0, 0, 0, 0
        for data in session.query(ClassificationResult).all():
            print(data.classification_id)
            denominator += 1
            if data.category_id == 9999: # count knowon image
                counterUnknown += 1
            if data.category_id == 1:
                counter1 += 1
            if data.category_id == 2:
                counter2 += 1
            if data.category_id == 3:
                counter3 += 1
        classfication_stats_arr = [counter1, counter2, counter3, counterUnknown, denominator]

        json_str = json.dumps(classfication_stats_arr)
        return json_str

#helper function
def allowed_file_type(filename):
	return '.' in filename and filename.rsplit('.', 1)[1] in ALLOWED_FILE_EXTENSIONS

#testing postgresql with sqlalchemy - test ok
db = SQLAlchemy(app)
engine = create_engine('postgresql://localhost/cmpe295')
Base.metadata.create_all(engine)
Session = sessionmaker(bind=engine)
session = Session()

# #create category instance in the db
# category1 = ImageCategories(category_name='couch')
# category2 = ImageCategories(category_name='mattress')
# category3 = ImageCategories(category_name='tv-monitor')
# category_unknown = ImageCategories(category_name='unknown')
# session.add(category1)
# session.add(category2)
# session.add(category3)
#
# # create image instance
# image1 = ImageData(category_id='1', path='abc/ccc', preProcessed = True)
# image2 = ImageData(category_id='2', path='abc/bbb', preProcessed = False)
# session.add(image1)
# session.add(image2)
#
# #create employee instance
# employee1 = UserData(userName='Andrew', user_password = 'a',workType='admin')
# employee2 = UserData(userName='Eric', user_password = 'b', workType='operator')
# session.add(employee1)
# session.add(employee2)
#
# #creaet unidentified image
# unidentified1 = UnIdentifiedImage(category_id='1', path='aaa/ccc')
# unidentified2 = UnIdentifiedImage(category_id='2', path='bbb/aaa')
# session.add(unidentified1)
# session.add(unidentified2)

#create image input
# imageinput1 = InputImageData(session_id='1', path='abc/a')
# session.add(imageinput1)
#create classification result
# classification1 = ClassificationResult(inputimage_id = '1', category_id='1', batch_id='1')
# classification2 = ClassificationResult(inputimage_id = '3', category_id='9999', batch_id='1')
# session.add(classification1)
# session.add(classification2)


# try:
# 	session.commit()
# except SQLAlchemyError as ex:
# 	session.rollback()
# 	print(str(ex))


# for image in session.query(ImageData).all():
# 	print("id", image.image_id)
# 	print("path", image.path)
# 	print("preprocessed", image.preProcessed)
# 	print("add date", image.createDate)
# 	print("preprcessed date", image.preprocessedDate)
# 	print("trained date", image.trainedDate)
#
# for employee in session.query(UserData).all():
# 	print("id", employee.user_id)
# 	print("name", employee.userName)
# 	print("preprocessed", employee.workType)
# 	print("add date", employee.createDate)
#
# for imagecategory in session.query(ImageCategories).all():
# 	print("id", imagecategory.category_id)
# 	print("category name", imagecategory.category_name)
#
# for unidentified in session.query(UnIdentifiedImage).all():
# 	print("id", unidentified.unidentified_id)
# 	print("unidentified category id", unidentified.category_id)
# 	print("unidentified path", unidentified.path)
# 	print("unidentified create date", unidentified.createDate)
#
# engine.dispose()

if __name__ == "__main__":
	app.run(debug=True)
