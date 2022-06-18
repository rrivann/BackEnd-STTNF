import db from '../config/Database.js';

class students {
  static all() {
    return new Promise((resolve, reject) => {
      const sql = 'SELECT * FROM students';

      db.query(sql, (err, results) => {
        resolve(results);
        reject(err);
      });
    });
  }

  static create(req) {
    const {name, nim, prodi, address} = req;

    return new Promise((resolve, reject) => {
      const sql = `INSERT INTO students (name, nim, prodi, address) VALUES ('${name}', '${nim}', '${prodi}', '${address}') `;

      db.query(sql, (err, results) => {
        resolve({
          id: results.insertId,
          name: name,
          nim: nim,
          prodi: prodi,
          address: address,
          created_at: null,
          updated_at: null,
        });
        reject(err);
      });
    });
  }
}

export default students;
