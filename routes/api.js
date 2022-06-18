// import express
import express from 'express';

// import Class StudentController
import StudentController from '../controllers/StudentController.js';

// create object express
const router = express.Router();

// create route
router.get('/', (req, res) => {
  res.send('Hello Express !');
});

// create route show students
router.get('/students', StudentController.index);

// create route show students by id
router.get('/students/:id', StudentController.find);

// create route add students
router.post('/students', StudentController.store);

// create route update students
router.put('/students/:id', StudentController.update);

// create route delete students
router.delete('/students/:id', StudentController.destroy);

// export router
export default router;
