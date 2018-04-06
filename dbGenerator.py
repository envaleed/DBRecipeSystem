
import random
from faker import Faker

fake= Faker('en_GB')

def creation():
    f = open("mealPlannerDB.sql","w")
    f.write("create database mealPlanner;\n")
    f.write("use mealPlanner;\n")
    f.write("\n")
    f.write("create table user(\n")
    f.write("userID varchar (10),\n")
    f.write("primary key (userID),\n")
    f.write("userEmail varchar(30),\n")
    f.write("userFname varchar(30),\n")
    f.write("userLname varchar(30),\n")
    f.write("userPassword varchar(30)\n")
    f.write(");\n")
    f.write("\n")
    f.close()

def creation2():
    f = open("mealPlannerDB.sql","a")
    f.write("\ncreate table profile(\n")
    f.write("userID varchar(10),\n")
    f.write("foreign key (userID) references user( userID) on delete cascade on update cascade,\n")
    f.write("profileID varchar(10),\n")
    f.write("primary key (profileID),\n")
    f.write("sex varchar(10),\n")
    f.write("height decimal (5,2),\n")
    f.write("weight decimal (5,2),\n")
    f.write("mealTypePreference varchar(30)\n")
    f.write(");\n")
    f.write("\n")
    f.close()

def creation3():
    f = open("mealPlannerDB.sql","a")
    f.write("\ncreate table recipe(\n")
    f.write("RecipeID varchar(10),\n")
    f.write("primary key (RecipeID),\n")
    f.write("prepTime decimal (5,2),\n")
    f.write("recipeName varchar (30),\n")
    f.write("creationDate date\n")
    f.write(");\n")
    f.write("\n")
    f.close()

def creation4():
    f = open("mealPlannerDB.sql","a")
    f.write("\ncreate table meals (\n")
    f.write("MealID varchar (10),\n")
    f.write("primary key (MealID),\n")
    f.write("calorieCount decimal (5,2),\n")
    f.write("mealImage varchar (100),\n")
    f.write("mealName varchar (30),\n")
    f.write("mealType varchar (30)\n")
    f.write(");\n")
    f.write("\n")
    f.close()

def creation5():
    f = open("mealPlannerDB.sql","a")
    f.write("\ncreate table mealPlan(\n")
    f.write("mealPlanID varchar (10),\n")
    f.write("day varchar (30),\n")
    f.write("primary key (mealPlanID),\n")
    f.write("totalCalorie decimal (5,2)\n")
    f.write(");\n")
    f.write("\n")
    f.close()

def creation6():
    f = open("mealPlannerDB.sql","a")
    f.write("\ncreate table ingredients(\n")
    f.write("ingredientsName varchar(30),\n")
    f.write("ingredientsNameID varchar(10),\n")
    f.write("primary key (ingredientsNameID),\n")
    f.write("MeasurementValue decimal (5,2),\n")
    f.write("MeasurementType varchar (10),\n")
    f.write("ingredCalorie decimal (5,2)\n")
    f.write(");\n")
    f.write("\n")
    f.close()

def creation7():
    f = open("mealPlannerDB.sql","a")
    f.write("\ncreate table instructions(\n")
    f.write("instructionName varchar (30),\n")
    f.write("instructionNameID varchar (10),\n")
    f.write("primary key (instructionNameID),\n")
    f.write("stepNum  int\n")
    f.write(");\n")
    f.write("\n")
    f.close()

def creation8():
    f = open("mealPlannerDB.sql","a")
    f.write("\ncreate table adds(\n")
    f.write("userID varchar (10),\n")
    f.write("primary key(userID),\n")
    f.write("creationDate date,\n")
    f.write("recipeName varchar(30)\n")
    f.write(");\n")
    f.write("\n")
    f.close()

def creation9():
    f = open("mealPlannerDB.sql","a")
    f.write("\ncreate table uses(\n")
    f.write("recipeID varchar (10),\n")
    f.write("primary key ( recipeID,instructionNameID,ingredientsNameID),\n")
    f.write("instructionNameID varchar (10),\n")
    f.write("foreign key (instructionNameID) references instructions(instructionNameID) on delete cascade on update cascade,\n")
    f.write("ingredientsNameID varchar (10),\n")
    f.write("foreign key (ingredientsNameID) references ingredients(ingredientsNameID) on delete cascade on update cascade,\n")
    f.write("measurementType varchar (30)\n")
    f.write(");\n")
    f.write("\n")
    f.close()

def creation10():
    f = open("mealPlannerDB.sql","a")
    f.write("\ncreate table make(\n")
    f.write("recipeID varchar (10),\n")
    f.write("mealID varchar (10),\n")
    f.write("primary key ( mealID),\n")
    f.write("foreign key (recipeID) references recipe(recipeID) on delete cascade on update cascade,\n")
    f.write("mealName varchar (30)\n")
    f.write(");\n")
    f.write("\n")
    f.close()

def creation11():
    f = open("mealPlannerDB.sql","a")
    f.write("\ncreate table generates(\n")
    f.write("mealID varchar(10),\n")
    f.write("mealPlanID varchar (10),\n")
    f.write("primary key (MealID,mealPLanID),\n")
    f.write("foreign key (mealPlanID) references mealPlan(mealPLanID) on delete cascade on update cascade,\n")
    f.write("foreign key (mealID) references meals(mealID) on delete cascade on update cascade\n")
    f.write(");\n")
    f.write("\n")
    f.close()


def user():
    id=0
    f = open("mealPlannerDB.sql","a")
    f.write("insert into user(userID,userEmail,userFname,userLname,userPassword)values\n")
    for i in range(150000):
        id+=1
        fname=fake.first_name()
        lname=fake.last_name()
        email = fake.email()
        password= fake.password()
        f.write('('+ '"' + str(id) + '",' +'"'+email+'",'+ '"' + fname + '",'+ '"' + lname+'",'+'"'+password+'"'+ ')')
        if i==149999:
            f.write(';\n')
            f.close()
        else:
            f.write(',\n')
    

def profile():
    userId=0
    profileId=0
    gender=["male","female"]
    preferences=["fish","chicken","vegetable","pork","vegie chunks","tofu"]
    f= open("mealPlannerDB.sql","a")
    f.write("\n")
    f.write("insert into profile(userID,profileID,sex,height,weight,mealTypePreference)values\n")
    for i in range(150000):
        userId+=1
        profileId+=1
        sex=random.choice(gender)
        height=random.choice(range(130, 200, 1))
        weight=random.choice(range(90,250,1))
        mealTypePreference=random.choice(preferences)
        f.write('('+'"'+str(userId)+'",'+'"'+str(profileId)+'",'+'"'+sex+'",'+'"'+str(height)+'",'+'"'+str(weight)+'",'+'"'+mealTypePreference+'"'+')')
        if i==149999:
            f.write(';\n')
            f.close()
        else:
            f.write(',\n')

def recipe():
    recipeId=0
    recipe=["Cocoa Trifle","Mint Mooncake","Guava Jam","Cherry Fudge","Cashew Wafer","Elderberry Buns"]
    f=open("mealPlannerDB.sql","a")
    f.write("\n")
    f.write("insert into recipe(recipeID,prepTime,recipeName,creationDate)values\n")
    for i in range(550000):
        recipeId+=1
        prepTime=random.choice(range(10,60,1))
        recipeName=random.choice(recipe)
        creationDate=fake.date()
        f.write('('+'"'+str(recipeId)+'",'+'"'+str(prepTime)+'",'+'"'+recipeName+'",'+'"'+creationDate+'"'+')')
        if i==549999:
            f.write(';\n')
            f.close()
        else:
            f.write(',\n')
    


def meals():
    mealId=0
    name=["Kiclete Bread","Dragon Pudding","Moss Paprika Roll","Ethereal Rice & Split","Wolpertinger Yogurt","Basilisk Ice Lollies","Osibola Buns"]
    ntype=["Breakfast","Second breakfast","Elevenses","Brunch","Lunch","Supper","Dinner","Snack","Value meal"]
    f=open("mealPlannerDB.sql","a")
    f.write("\n")
    f.write("insert into meals(mealID,calorieCount,mealImage,mealName,mealType)values\n")
    for i in range (150000):
        mealId+=1
        calorieCount=random.choice(range(10,300,1))
        mealName=random.choice(name)
        mealType=random.choice(ntype)
        f.write('('+'"'+str(mealId)+'",'+'"'+str(calorieCount)+'",'+'"'+'",'+'"'+mealName+'",'+'"'+mealType+'"'+')')
        if i==149999:
            f.write(';\n')
            f.close()
        else:
            f.write(',\n')
    
            
def mealPlan():
    mealplanId=0
    days=["sunday","monday","tuesday","wednesday","thursday","friday","saturday"]
    f=open("mealPlannerDB.sql","a")
    f.write("\n")
    f.write("insert into mealPlan(mealPlanID,day,totalCalorie)values\n")
    for i in range (150000):
        mealplanId+=1
        day=random.choice(days)
        totalCalorie=random.choice(range(10,200,1))
        f.write('('+'"'+str(mealplanId)+'",'+'"'+day+'",'+'"'+str(totalCalorie)+'"'+')')
        if i==149999:
            f.write(';\n')
            f.close()
        else:
            f.write(',\n')
       


def ingredients():
    inID=0
    mtype=["teaspoon","tablespoon","gill","cup","pint","quart","gallon","pound","ounce","mg","kg","mm","inch"]
    f=open("mealPlannerDB.sql","a")
    f.write("\n")
    f.write("insert into ingredients(ingredientsNameID,ingredientsName,measurementValue,measurementType,ingredCalorie)values\n")
    for i in range (150000):
        inID+=1
        ingredname=fake.word()
        mv=random.choice(range(1,200,1))
        measuret=random.choice(mtype)
        incalorie=random.choice(range(1,200,1))
        f.write('('+'"'+str(inID)+'",'+'"'+ingredname+'",'+'"'+str(mv)+'",'+'"'+measuret+'",'+'"'+str(incalorie)+'"'+')')
        if i==149999:
            f.write(';\n')
            f.close()
        else:
            f.write(',\n')
       
        
    

def instructions():
    sid=0
    f=open("mealPlannerDB.sql","a")
    f.write("\n")
    f.write("insert into instructions(instructionNameID,instructionName,stepNum)values\n")
    for i in range (150000):
        sid+=1
        struct=fake.word()
        snum=random.choice(range(1,50,1))
        f.write('('+'"'+str(sid)+'",'+'"'+struct+'",'+'"'+str(snum)+'"'+')')
        if i==149999:
            f.write(';\n')
            f.close()
        else:
            f.write(',\n')
    
                           

def generates():
    mealId=0
    plnid=0
    f=open("mealPlannerDB.sql","a")
    f.write("\n")
    f.write("insert into generates(mealID,mealPlanID)values\n")
    for i in range (150000):
        mealId+=1
        plnid+=1
        f.write('('+'"'+str(mealId)+'",'+'"'+str(plnid)+'"'+')')
        if i==149999:
            f.write(';\n')
            f.close()
        else:
            f.write(',\n')
    

def adds():
    userId=0
    recipe=["Cocoa Trifle","Mint Mooncake","Guava Jam","Cherry Fudge","Cashew Wafer","Elderberry Buns"]
    f=open("mealPlannerDB.sql","a")
    f.write("\n")
    f.write("insert into adds(userID,creationDate,recipeName)values\n")
    for i in range (150000):
        userId+=1
        cd=fake.date()
        rn=random.choice(recipe)
        f.write('('+'"'+str(userId)+'",'+'"'+str(cd)+'",'+'"'+rn+'"'+')')
        if i==149999:
            f.write(';\n')
            f.close()
        else:
            f.write(',\n')
    

def makes():
    rid=0
    mid=0
    name=["Kiclete Bread","Dragon Pudding","Moss Paprika Roll","Ethereal Rice & Split","Wolpertinger Yogurt","Basilisk Ice Lollies","Osibola Buns"]
    f=open("mealPlannerDB.sql","a")
    f.write("\n")
    f.write("insert into make(recipeID,mealID,mealName)values\n")
    for i in range (150000):
        rid+=1
        mid+=1
        nm=random.choice(name)
        f.write('('+'"'+str(rid)+'",'+'"'+str(mid)+'",'+'"'+nm+'"'+')')
        if i==149999:
            f.write(';\n')
            f.close()
        else:
            f.write(',\n')
def uses():
    rid=0
    insid=0
    ingid=0
    mtype=["teaspoon","tablespoon","gill","cup","pint","quart","gallon","pound","ounce","mg","kg","mm","inch"]
    f=open("mealPlannerDB.sql","a")
    f.write("\n")
    f.write("insert into uses(recipeID,instructionNameID,ingredientsNameID,measurementType)values\n")
    for i in range (150000):
        rid+=1
        insid+=1
        ingid+=1
        r=random.choice(mtype)
        f.write('('+'"'+str(rid)+'",'+'"'+str(insid)+'",'+'"'+str(ingid)+'",'+'"'+r+'"'+')')
        if i==149999:
            f.write(';\n')
            f.close()
        else:
            f.write(',\n')

def doAll():
    creation()
    user()
    creation2()
    profile()
    creation3()
    recipe()
    creation4()
    meals()
    creation5()
    mealPlan()
    creation6()
    ingredients()
    creation7()
    instructions()
    creation8()
    adds()
    creation9()
    uses()
    creation10()
    makes()
    creation11()
    generates()
