import sys
import base64
import cv2
import numpy as np
import mediapipe as mp
import joblib
import json

def decode_image(base64_string):
    image_data = base64.b64decode(base64_string)
    np_array = np.frombuffer(image_data, dtype=np.uint8)
    return cv2.imdecode(np_array, cv2.IMREAD_COLOR)

def extract_keypoints(results):
    return [coord for lm in results.pose_landmarks.landmark for coord in (lm.x, lm.y)]

# Load model
model = joblib.load("model/calorie_model.pkl")

# Read base64 image input
img_data = sys.stdin.read()
img = decode_image(img_data)

mp_pose = mp.solutions.pose
pose = mp_pose.Pose()
results = pose.process(cv2.cvtColor(img, cv2.COLOR_BGR2RGB))

if results.pose_landmarks:
    features = extract_keypoints(results)
    if len(features) == 66:  # 33 keypoints x 2
        calories = model.predict([features])[0]
        print(json.dumps({"calories": round(calories)}))
    else:
        print(json.dumps({"error": "Invalid keypoints"}))
else:
    print(json.dumps({"error": "No pose detected"}))
