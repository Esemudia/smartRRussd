const express = require('express');
const bodyParser = require('body-parser');
const hausa = require('./router/Hausa');
const client = require('./database')

const db = require('./conn/conn'); // Assuming you have a database connection module

const app = express();
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

app.post('/ussd', async (req, res) => {
    const { sessionId, serviceCode, phoneNumber, text } = req.body;
    let response = '';
    const Myarray=[];
    const reps=[];
    switch (text) {
        case'':
        try {
            const query = 'SELECT * FROM language';
            const results = await client.query(query); 

            if (results.length > 0) {
                results.forEach((row) => {
                    if (row.id === "Language") {
                        response = 'CON What would you like to check\n';
                        const keys = Object.keys(row);
                        for (let index = 1; index < keys.length; index++) {
                            response += `${index}."  ${keys[index]}\n`;
                        }
                        response += '*. Cancel';
                    }
                });
            }
        } catch (error) {
            console.error("Error executing query:", error);
            response = 'END An error occurred. Please try again later.';
        }
        break;
        case '*':
            response = `END Your phone number is ${phoneNumber}`;
            break;

        case '1':
            try {
                const arr=[];
                const query = `SELECT questions FROM question where language="English"`;
                const results = await db.query(query); 
    
                if (results.length > 0) {
                    results.forEach( (row) => {
                        Myarray.push(row);})
                        response=`CON ${Myarray[0]} \n`
                        response+=`1. Yes\n`
                        response+=`2. No\n`
                       if(text=="1*1"){
                            let res= ``
                            const arr=[];
                            const query = `SELECT state FROM state`;
                            const result3 = await db.query(query); 
                            if (result3.length>0) {
                                result3.forEach((row) => {
                                    reps.push(row) 
                                });
                                response=`CON ${Myarray[1]}\n`
                                response+=`1. ${reps[0]}\n`
                                response+=`2. ${reps[1]}\n`
                                response+=`3. ${reps[2]}\n`

                                if (text=="1") {
                                    const arr=[];
                                    const query = `SELECT location FROM where state="${reps[0]}"`;
                                    const result3 = await db.query(query); 

                                }
                                if (condition) {
                                    
                                }
                                if (condition) {
                                    
                                }
                            }
                       }
                }
            } catch (error) {
                
            }
            break;

    } 

    res.set('Content-Type', 'text/plain');
    res.send(response);
});

app.listen(3000, () => {
    console.log('USSD service running on port 3000');
});
