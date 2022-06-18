// Import Data Students
import Students from '../models/Students.js';

// Create Class Student Controller
class StudentController {
  async index(req, res) {
    const students = await Students.all();

    const response = {
      message: 'get all students',
      data: students,
    };

    res.json(response);
  }

  async store(req, res) {
    const students = await Students.create(req.body);

    const data = {
      message: 'Add data student',
      data: students,
    };

    res.json(data);
  }

  update(req, res) {}

  destroy(req, res) {}
}

const objectStudentController = new StudentController();

export default objectStudentController;
