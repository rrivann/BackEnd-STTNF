import db from '../config/Database.js';

class Students {
  static tableName = 'students';

  static query(sql, body, callback) {
    return new Promise((resolve, reject) => {
      db.query(sql, body, (err, results) => {
        resolve(callback(results));
      });
    });
  }

  static all() {
    const sql = `SELECT * FROM ${this.tableName}`;
    return this.query(sql, null, (result) => result);
  }

  static find(id) {
    const sql = `SELECT * FROM ${this.tableName} WHERE id = ?`;
    return this.query(sql, id, (result) => result);
  }

  static async create(body) {
    const sql = `INSERT INTO ${this.tableName} SET ?`;
    const id = await this.query(sql, body, (result) => result.insertId);
    return this.find(id);
  }

  static async update(id, body) {
    const sql = `UPDATE ${this.tableName} SET ? WHERE id = ${id}`;
    await this.query(sql, body, (result) => result);

    return this.find(id);
  }

  static delete(id) {
    const sql = `DELETE FROM ${this.tableName} WHERE id = ?`;
    return this.query(sql, id, (result) => result);
  }
}

export default Students;
