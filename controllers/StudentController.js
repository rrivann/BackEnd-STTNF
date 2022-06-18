// Import Data Students
import Students from '../models/Students.js';

// Create Class Student Controller
class StudentController {
  async index(req, res) {
    let response = {};
    const students = await Students.all();

    if (students.length > 0) {
      response = {
        message: 'Get all students',
        data: students,
      };

      return res.status(200).json(response);
    }
    response = {
      message: 'Students is empty',
      data: students,
    };

    return res.status(404).json(response);
  }

  async find(req, res) {
    let response = {};
    const {id} = req.params;
    const student = await Students.find(id);

    if (student.length > 0) {
      response = {
        message: `Find student ID : ${id}`,
        data: student,
      };
      return res.status(200).json(response);
    }

    response = {
      message: "Student data doesn't exist",
    };
    return res.status(404).json(response);
  }

  async store(req, res) {
    let response = {};
    const {name, nim, prodi, address} = req.body;

    if (!name || !nim || !prodi || !address) {
      response = {
        message: 'all data mush be sent',
      };
      return res.status(422).json(response);
    }

    const student = await Students.create({name, nim, prodi, address});

    response = {
      message: 'Add data student',
      data: student,
    };

    res.status(201).json(response);
  }

  async update(req, res) {
    let response = {};
    const {id} = req.params;
    const student = await Students.find(id);

    if (student.length > 0) {
      const update = await Students.update(id, req.body);
      response = {
        message: 'Update students',
        data: update,
      };
      return res.status(200).json(response);
    }
    response = {
      message: `Student data doesn't exist`,
    };
    return res.status(404).json(response);
  }

  async destroy(req, res) {
    let response = {};
    const {id} = req.params;
    const student = await Students.find(id);

    if (student.length > 0) {
      await Students.delete(id);
      response = {
        message: 'Success delete student data',
        data: student,
      };
      return res.status(200).json(response);
    }
    response = {
      message: `Student data doesn't exist`,
    };
    return res.status(404).json(response);
  }
}

const objectStudentController = new StudentController();

export default objectStudentController;
