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
    public class Clients
    {
        private string sFirstName;
        private string sEmail;
        private string sLastName;
        private string sAddress;
        private string sCity;
        private string sState;
        private string sZip;
        private string sPhone;
        private string sComments;
        private string sComments1;
        private int nID;
        private bool flgIsNew = false;
        private bool flgDeleted = false;

        private static int nMAXID = 0;

        public string FirstName
        {
            get { return sFirstName; }
            set { sFirstName = value; }
        }
        
        public string Email
        {
            get { return sEmail; }
            set { sEmail = value; }
        }
        public string LastName
        {
            get { return sLastName; }
            set { sLastName = value; }
        }
        public string Address
        {
            get { return sAddress; }
            set { sAddress = value; }
        }
        public string City
        {
            get { return sCity; }
            set { sCity = value; }
        }
        public string State
        {
            get { return sState; }
            set { sState = value; }
        }
        public string Zip
        {
            get { return sZip; }
            set { sZip = value; }
        }
        public string Comments
        {
            get { return sComments; }
            set { sComments = value; }
        }
        public string Phone
        {
            get { return sPhone; }
            set { sPhone = value; }
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


        public Clients()
        {
            if (nMAXID == 0)
                nMAXID = GetMaxID();
            nMAXID++;


            sFirstName = "";
            sEmail = "";
            sLastName = "";
            sAddress = "";
            sCity = "";
            sState = "";
            sZip = "";
            sPhone = "";
            sComments = "";
            nID = nMAXID;

            flgIsNew = true;
        }

        public Clients(int ID)
        {
            MySqlConnection conGet = new MySqlConnection(MySQLRunner.ConnectionString);
            MySqlDataReader drGet = null;
            string sSQL = "";

            sSQL = "SELECT * FROM clients WHERE userid=" + ID.ToString();

            if (MySQLRunner.ExecuteQuery(sSQL, conGet, ref drGet) == true)
            {
                drGet.Read();

                if (drGet.HasRows == false)
                {
                    if (nMAXID == 0)
                        nMAXID = GetMaxID();

                    nMAXID++;

                    sFirstName = "";
                    sEmail = "";
                    sLastName = "";
                    sAddress = "";
                    sCity = "";
                    sState = "";
                    sZip = "";                    
                    sPhone = "";
                    sComments = "";
                    nID = 0;

                    flgIsNew = true;
                }
                else
                {
                    sFirstName = drGet.GetString(drGet.GetOrdinal("first_name"));
                    sEmail = drGet.GetString(drGet.GetOrdinal("email"));
                    sLastName = drGet.GetString(drGet.GetOrdinal("last_name"));
                    sAddress = drGet.GetString(drGet.GetOrdinal("street_address"));
                    sCity = drGet.GetString(drGet.GetOrdinal("city"));
                    sState = drGet.GetString(drGet.GetOrdinal("state"));
                    sZip = drGet.GetString(drGet.GetOrdinal("zip"));                    
                    sPhone = drGet.GetString(drGet.GetOrdinal("phone"));
                    sComments = drGet.GetString(drGet.GetOrdinal("comments"));
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

            sSQL = "UPDATE clients SET " +
                     "first_name='" + sFirstName + "', " +
                     "last_name='" + sLastName + "', " +
                     "email='" + sEmail + "', " +
                     "street_address='" + sAddress + "', " +
                     "city='" + sCity + "', " +
                     "state='" + sState + "', " +
                     "zip='" + sZip + "', " +
                     "phone='" + sPhone + "', " +
                     "comments='" + sComments + "' " +
                     "WHERE userid=" + nID.ToString();

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

            sSQL = "INSERT into clients (first_name, last_name, street_address, city, state, zip, phone, email, comments) VALUES ( " +
                   "'" + sFirstName + "', " +
                   "'" + sLastName + "', " +
                   "'" + sAddress + "', " +
                   "'" + sCity + "', " +
                   "'" + sState + "', " +
                   "'" + sZip + "', " +
                   "'" + sPhone + "', " +
                   "'" + sEmail + "', " +
                   "'" + sComments + "');";


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

            sSQL = "DELETE FROM clients WHERE userid=" + nID.ToString();

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

            sSQL = "SELECT MAX(userid) AS ID FROM clients";

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