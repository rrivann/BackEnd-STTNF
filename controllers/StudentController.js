// Import Data Students
import dataStudents from '../data/students.js';

// Create Class Student Controller
class StudentController {
  index(req, res) {
    const data = {
      message: 'show student data',
      data: dataStudents,
    };
    res.send(data);
  }

  store(req, res) {
    const {nama} = req.body;
    dataStudents.push(nama);
    const data = {
      message: 'add student data: ' + nama,
      data: dataStudents,
    };
    res.send(data);
  }

  update(req, res) {
    const {id} = req.params;
    console.log(id);
    const {nama} = req.body;
    const index = dataStudents.findIndex((v, i) => i == id);
    dataStudents[index] = nama;
    const data = {
      message: `update student data id ${id}, name ${nama} `,
      data: dataStudents,
    };
    res.send(data);
  }

  destroy(req, res) {
    const {id} = req.params;
    dataStudents.splice(id, 1);
    const data = {
      message: `delete student id ${id}`,
      data: dataStudents,
    };
    res.send(data);
  }
}

const objectStudentController = new StudentController();

export default objectStudentController;
