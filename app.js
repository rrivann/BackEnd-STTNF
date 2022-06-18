// import express
import express from 'express';

// import router
import router from './routes/api.js';

// create object express
const app = express();

// definition port
app.listen(3000);
// use middleware json
app.use(express.json());
// use router
app.use(router);
