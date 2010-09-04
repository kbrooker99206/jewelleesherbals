using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using MySql.Data.MySqlClient;
using DBI;
using DBI.MySQL;
using Utilities;


namespace JewelleesMySQL
{
    public class Submissions
    {
        private string sName;
        private string sPhone;
        private string sEmail;
        private string sInquiry;
        private string sNotes;
        private int nID;
        private bool flgIsNew = false;
        private bool flgDeleted = false;

        private static int nMAXID = 0;

        public string Name
        {
            get { return sName; }
            set { sName = value; }
        }
        public string Phone
        {
            get { return sPhone; }
            set { sPhone = value; }
        }
        public string Email
        {
            get { return sEmail; }
            set { sEmail = value; }
        }
        public string Inquiry
        {
            get { return sInquiry; }
            set { sInquiry = value; }
        }
        public string Notes
        {
            get { return sNotes; }
            set { sNotes = value; }
        }
        public int ID
        {
            get { return nID; }
            set { nID = value; }
        }

        public bool IsNew
        {
            get { return flgIsNew; }
        }


        public Submissions()
        {
            if (nMAXID == 0)
                nMAXID = GetMaxID();
            nMAXID++;

            sName = "";
            sPhone = "";
            sEmail = "";
            sInquiry = "";
            nID = nMAXID;

            flgIsNew = true;
        }

        public Submissions(int ID)
        {
            MySqlConnection conGet = new MySqlConnection(MySQLRunner.ConnectionString);
            MySqlDataReader drGet = null;
            string sSQL = "";

            sSQL = "SELECT * FROM submissions WHERE id=" + ID.ToString();

            if (MySQLRunner.ExecuteQuery(sSQL, conGet, ref drGet) == true)
            {
                drGet.Read();

                if (drGet.HasRows == false)
                {
                    if (nMAXID == 0)
                        nMAXID = GetMaxID();

                    nMAXID++;

                    sName = "";
                    sPhone = "";
                    sEmail = "";
                    sInquiry = "";
                    sNotes = "";
                    nID = 0;

                    flgIsNew = true;
                }
                else
                {
                    sName = drGet.GetString(drGet.GetOrdinal("name"));
                    sPhone = drGet.GetString(drGet.GetOrdinal("phone"));
                    sEmail = drGet.GetString(drGet.GetOrdinal("email"));
                    sInquiry = drGet.GetString(drGet.GetOrdinal("inquiry"));
                    sNotes = drGet.GetString(drGet.GetOrdinal("notes"));
                    nID = ID;
                    flgIsNew = false;
                }
            }
            else
            {
                MessageBox.Show("Error connecting to the database.");
            }

            if (conGet.State == ConnectionState.Open)
            {
                if (drGet != null)
                    drGet.Close();

                conGet.Close();
            }
        }

        public void Delete()
        {
            flgDeleted = true;
        }

        public bool Save()
        {
            bool flgReturn;

            if (flgDeleted == false)
            {
                if (flgIsNew == true)
                    flgReturn = Add();
                else
                    flgReturn = Update();
            }
            else
            {
                flgReturn = DeleteObject();
            }

            if (flgReturn == true)
                flgIsNew = false;

            return flgReturn;
        }

        private bool Update()
        {
            MySqlConnection conUpdate = new MySqlConnection(MySQLRunner.ConnectionString);
            string sSQL = "";
            bool flgReturn = false;
            sSQL = "UPDATE submissions SET " +
                     "name='" + sName + "', " +
                     "phone='" + sPhone + "', " +
                     "email='" + sEmail + "', " +
                     "inquiry='" + sInquiry + "', " +
                     "notes='" + sNotes + "' " +
                     "WHERE id=" + nID.ToString();
            if (MySQLRunner.ExecuteNonQuery(sSQL, conUpdate) == false)
                flgReturn = false;
            else
                flgReturn = true;
            if (conUpdate.State == ConnectionState.Open)
            {
                conUpdate.Close();
            }
            return flgReturn;
        }

        private bool Add()
        {
            MySqlConnection conAdd = new MySqlConnection(MySQLRunner.ConnectionString);
            string sSQL = "";
            bool flgReturn = false;
            sSQL = "INSERT into pages(name, phone, email,inquiry) VALUES('" + sName + "','" + sPhone + "', '" + sEmail + "', '" + sInquiry + "')";
            if (MySQLRunner.ExecuteNonQuery(sSQL, conAdd) == false)
                flgReturn = false;
            else
                flgReturn = true;

            if (conAdd.State == ConnectionState.Open)
            {
                conAdd.Close();
            }
            return flgReturn;
        }

        public bool DeleteObject()
        {
            MySqlConnection conDelete = new MySqlConnection(MySQLRunner.ConnectionString);
            string sSQL = "";
            bool flgReturn = false;

            sSQL = "DELETE FROM submissions WHERE id=" + nID.ToString();

            if (MySQLRunner.ExecuteNonQuery(sSQL, conDelete) == false)
                flgReturn = false;
            else
                flgReturn = true;

            if (conDelete.State == ConnectionState.Open)
            {
                conDelete.Close();
            }

            return flgReturn;
        }

        private int GetMaxID()
        {
            MySqlConnection conGet = new MySqlConnection(MySQLRunner.ConnectionString);
            MySqlDataReader drGet = null;
            string sSQL = "";
            int nMax = 0;

            sSQL = "SELECT MAX(id) AS ID FROM submissions";

            if (MySQLRunner.ExecuteQuery(sSQL, conGet, ref drGet) == true)
            {
                drGet.Read();

                if (drGet.HasRows == false)
                {
                    nMax = 0;
                }
                else
                {
                    nMax = drGet.GetInt32(drGet.GetOrdinal("ID"));
                }
            }
            else
            {
                MessageBox.Show("Error connecting to the database.");
            }

            if (conGet.State == ConnectionState.Open)
            {
                if (drGet != null)
                    drGet.Close();

                conGet.Close();
            }

            return nMax;
        }
    }
}
