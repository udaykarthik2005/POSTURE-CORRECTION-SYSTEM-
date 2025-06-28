from flask import Flask, request, jsonify
import pandas as pd
import random

app = Flask(__name__)

food_database = {
    "low_calorie": ["Apple", "Cucumber", "Carrots", "Greek Yogurt"],
    "protein_rich": ["Chicken Breast", "Eggs", "Lentils", "Tofu"],
    "balanced": ["Brown Rice", "Fish", "Mixed Vegetables", "Nuts"]
}

# Sample diet plans
diet_plans = {
    "weight_loss": ["Oatmeal with fruits", "Grilled chicken salad", "Steamed veggies with fish"],
    "muscle_gain": ["Scrambled eggs with avocado", "Chicken breast with quinoa", "Protein shake"],
    "maintenance": ["Greek yogurt with nuts", "Brown rice with tofu", "Mixed vegetable soup"]
}

# Sample workout plans
workout_plans = {
    "weight_loss": ["Cardio (30 mins)", "HIIT (20 mins)", "Jump Rope (15 mins)"],
    "muscle_gain": ["Strength training (45 mins)", "Push-ups & pull-ups", "Weight lifting"],
    "maintenance": ["Yoga", "Cycling", "Jogging (30 mins)"]
}

@app.route("/recommend", methods=["POST"])
def recommend():
    data = request.json
    goal = data.get("goal", "maintenance")

    diet = random.choice(diet_plans.get(goal, diet_plans["maintenance"]))
    workout = random.choice(workout_plans.get(goal, workout_plans["maintenance"]))

    return jsonify({"diet": diet, "workout": workout})

@app.route("/suggest_food", methods=["POST"])
def suggest_food():
    data = request.json
    goal = data.get("goal", "balanced")  # Default: balanced diet

    suggested_food = random.choice(food_database.get(goal, food_database["balanced"]))

    return jsonify({"food_suggestion": suggested_food})

@app.route("/suggest_workout", methods=["POST"])
def suggest_workout():
    data = request.json
    goal = data.get("goal", "weight_loss")  # Default: weight loss

    suggested_workout = random.choice(workout_database.get(goal, workout_database["weight_loss"]))

    return jsonify({"workout_suggestion": suggested_workout})





if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
