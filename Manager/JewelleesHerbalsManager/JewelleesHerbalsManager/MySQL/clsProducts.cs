//using System;
//using System.Collections.Generic;
//using System.ComponentModel;
//using System.Data;
//using System.Drawing;
//using System.Text;
//using System.Windows.Forms;
//using MySql.Data.MySqlClient;
//using DBI;
//using DBI.MySQL;
//using Utilities;

//namespace JewelleesMySQL
//{
//    public class Products
//    {
//        private string sName;
//        private string sCategory;
//        private string sDescription;
//        private string sPrice;
//        private string sImage;
//        private string sWeight;
//        private string sPaypalType;
//        private string sPaypalPrice;
//        private string sPaypalWeight;
//        private int nID;
//        private bool flgIsNew = false;
//        private bool flgDeleted = false;

//        private static int nMAXID = 0;

//        public string Name
//        {
//            get { return sName; }
//            set { sName = value; }
//        }
//        public string Description
//        {
//            get { return sDescription; }
//            set { sDescription = value; }
//        }
//        public string Category
//        {
//            get { return sCategory; }
//            set { sCategory = value; }
//        }
//        public string Price
//        {
//            get { return sPrice; }
//            set { sPrice = value; }
//        }
//        public string Image
//        {
//            get { return sImage; }
//            set { sImage = value; }
//        }
//        public string Weight
//        {
//            get { return sWeight; }
//            set { sWeight = value; }
//        }
//        public string PaypalType
//        {
//            get { return sPaypalType; }
//            set { sPaypalType = value; }
//        }
//        public string PaypalPrice
//        {
//            get { return sPaypalPrice; }
//            set { sPaypalPrice = value; }
//        }
//        public string PaypalWeight
//        {
//            get { return sPaypalWeight; }
//            set { sPaypalWeight = value; }
//        }
//        public int ID
//        {
//            get { return nID; }
//            set { nID = value; }
//        }

//        public bool IsNew
//        {
//            get { return flgIsNew; }
//        }


//        public Products()
//        {
//            if (nMAXID == 0)
//                nMAXID = GetMaxID();
//            nMAXID++;

//            sName = "";
//            sDescription = "";
//            sCategory = "";
//            sPrice = "";
//            sWeight = "";
//            sImage = "";
//            sPaypalType = "";
//            sPaypalPrice = "";
//            sPaypalWeight = "";
//            nID = nMAXID;

//            flgIsNew = true;
//        }

//        public Products(int ID)
//        {
//            MySqlConnection conGet = new MySqlConnection(MySQLRunner.ConnectionString);
//            MySqlDataReader drGet = null;
//            string sSQL = "";

//            sSQL = "SELECT * FROM products WHERE id=" + ID.ToString();

//            if (MySQLRunner.ExecuteQuery(sSQL, conGet, ref drGet) == true)
//            {
//                drGet.Read();

//                if (drGet.HasRows == false)
//                {
//                    if (nMAXID == 0)
//                        nMAXID = GetMaxID();

//                    nMAXID++;

//                    sName = "";
//                    sDescription = "";
//                    sCategory = "";
//                    sPrice = "";
//                    sWeight = "";
//                    sImage = "";
//                    sPaypalType = "";
//                    sPaypalPrice = "";
//                    sPaypalWeight = "";
//                    nID = 0;

//                    flgIsNew = true;
//                }
//                else
//                {
//                    sName = drGet.GetString(drGet.GetOrdinal("product_name"));
//                    sDescription = drGet.GetString(drGet.GetOrdinal("product_description"));
//                    sCategory = drGet.GetString(drGet.GetOrdinal("category"));
//                    sPrice = drGet.GetString(drGet.GetOrdinal("product_price"));
//                    sImage = drGet.GetString(drGet.GetOrdinal("product_image"));
//                    sWeight = drGet.GetString(drGet.GetOrdinal("product_weight"));
//                    sPaypalType = drGet.GetString(drGet.GetOrdinal("paypaltype"));
//                    sPaypalPrice = drGet.GetString(drGet.GetOrdinal("paypalprice"));
//                    sPaypalWeight = drGet.GetString(drGet.GetOrdinal("paypalweight"));
//                    nID = ID;
//                    flgIsNew = false;
//                }
//            }
//            else
//            {
//                MessageBox.Show("Error connecting to the database.");
//            }

//            if (conGet.State == ConnectionState.Open)
//            {
//                if (drGet != null)
//                    drGet.Close();

//                conGet.Close();
//            }
//        }

//        public void Delete()
//        {
//            flgDeleted = true;
//        }

//        public bool Save()
//        {
//            bool flgReturn;

//            if (flgDeleted == false)
//            {
//                if (flgIsNew == true)
//                    flgReturn = Add();
//                else
//                    flgReturn = Update();
//            }
//            else
//            {
//                flgReturn = DeleteObject();
//            }

//            if (flgReturn == true)
//                flgIsNew = false;

//            return flgReturn;
//        }

//        private bool Update()
//        {
//            MySqlConnection conUpdate = new MySqlConnection(MySQLRunner.ConnectionString);
//            string sSQL = "";
//            bool flgReturn = false;
//            sSQL = "UPDATE products SET " +
//                     "product_name='" + sName + "', " +
//                     "category='" + sCategory + "', " +
//                     "product_description='" + sDescription + "', " +
//                     "product_price='" + sPrice + "', " +
//                     "product_image='" + sImage + "', " +
//                     "product_weight='" + sWeight + "', " +
//                     "paypaltype='" + sPaypalType + "', " +
//                     "paypalprice='" + sPaypalPrice + "', " +
//                     "paypalweight='" + sPaypalWeight + "' " +
//                     "WHERE id=" + nID.ToString();
//            if (MySQLRunner.ExecuteNonQuery(sSQL, conUpdate) == false)
//                flgReturn = false;
//            else
//                flgReturn = true;
//            if (conUpdate.State == ConnectionState.Open)
//            {
//                conUpdate.Close();
//            }
//            return flgReturn;
//        }

//        private bool Add()
//        {
//            MySqlConnection conAdd = new MySqlConnection(MySQLRunner.ConnectionString);
//            string sSQL = "";
//            bool flgReturn = false;
//            sSQL = "INSERT into products (product_name, product_description, category, product_image, product_weight, paypaltype, paypalprice, paypalweight) VALUES('" + sName + "','" + sDescription + "','" + sCategory + "','" + sImage + "','" + sWeight + "','" + sPaypalType + "','" + sPaypalPrice + "','" + sPaypalWeight + "')";
//            if (MySQLRunner.ExecuteNonQuery(sSQL, conAdd) == false)
//                flgReturn = false;
//            else
//                flgReturn = true;

//            if (conAdd.State == ConnectionState.Open)
//            {
//                conAdd.Close();
//            }
//            return flgReturn;
//        }

//        public bool DeleteObject()
//        {
//            MySqlConnection conDelete = new MySqlConnection(MySQLRunner.ConnectionString);
//            string sSQL = "";
//            bool flgReturn = false;

//            sSQL = "DELETE FROM products WHERE id=" + nID.ToString();

//            if (MySQLRunner.ExecuteNonQuery(sSQL, conDelete) == false)
//                flgReturn = false;
//            else
//                flgReturn = true;

//            if (conDelete.State == ConnectionState.Open)
//            {
//                conDelete.Close();
//            }

//            return flgReturn;
//        }

//        private int GetMaxID()
//        {
//            MySqlConnection conGet = new MySqlConnection(MySQLRunner.ConnectionString);
//            MySqlDataReader drGet = null;
//            string sSQL = "";
//            int nMax = 0;

//            sSQL = "SELECT MAX(id) AS ID FROM products";

//            if (MySQLRunner.ExecuteQuery(sSQL, conGet, ref drGet) == true)
//            {
//                drGet.Read();

//                if (drGet.HasRows == false)
//                {
//                    nMax = 0;
//                }
//                else
//                {
//                    nMax = drGet.GetInt32(drGet.GetOrdinal("ID"));
//                }
//            }
//            else
//            {
//                MessageBox.Show("Error connecting to the database.");
//            }

//            if (conGet.State == ConnectionState.Open)
//            {
//                if (drGet != null)
//                    drGet.Close();

//                conGet.Close();
//            }

//            return nMax;
//        }
//    }
//}