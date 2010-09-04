using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Net.Sockets;
using System.Text;
using System.Windows.Forms;
using Microsoft.Win32;
using System.Diagnostics;
using System.Configuration;
using MySql.Data.MySqlClient;
using MysqlLib;
using MysqlLib.Command;

namespace JewelleesMySQL
{
    public class Lists
    {
        /*******************
          * Pages Sorted List
          *******************/
        public static List<Pages> GetAllAccounts()
        {
            List<Pages> accounts = new List<Pages>();

            AsyncMysqlQuery query = new AsyncMysqlQuery("CALL swganh_utility.sp_AdminAccountList();");

            query.SetHandler(delegate(MySqlDataReader reader)
            {
                if (query.Error == null)
                {
                    while (reader.Read())
                    {
                        Account account = new Account(reader);
                        accounts.Add(account);
                    }
                }
                else
                {
                    Console.WriteLine("something went wrong");
                }


            });

            Database.Utility.ExecuteSync(query);
            return accounts;

        }
        /*******************
          * Submissions Sorted List
          *******************/
        public static SortedList<int, Submissions> SubmissionList()
        {
            SortedList<int, Submissions> lsSubmissions = new SortedList<int, Submissions>();
            MySqlConnection conGet = new MySqlConnection(MySQLRunner.ConnectionString);
            MySqlDataReader drGet = null;
            string sSQL = "";
            Submissions oSubmission;

            sSQL = "SELECT id FROM submissions";

            if (MySQLRunner.ExecuteQuery(sSQL, conGet, ref drGet) == true)
            {

                while (drGet.Read())
                {
                    oSubmission = new Submissions(drGet.GetInt32(drGet.GetOrdinal("id")));
                    lsSubmissions.Add(oSubmission.ID, oSubmission);
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
            return lsSubmissions;
        }
        /*******************
          * Product Cats Sorted List
          *******************/
        public static SortedList<int, ProductCats> ProductCatsList()
        {
            SortedList<int, ProductCats> lsProductCats = new SortedList<int, ProductCats>();
            MySqlConnection conGet = new MySqlConnection(MySQLRunner.ConnectionString);
            MySqlDataReader drGet = null;
            string sSQL = "";
            ProductCats oProductCat;

            sSQL = "SELECT id FROM product_category";

            if (MySQLRunner.ExecuteQuery(sSQL, conGet, ref drGet) == true)
            {

                while (drGet.Read())
                {
                    oProductCat = new ProductCats(drGet.GetInt32(drGet.GetOrdinal("id")));
                    lsProductCats.Add(oProductCat.ID, oProductCat);
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
            return lsProductCats;
        }
        /*******************
         * Products Sorted List
         *******************/
        public static SortedList<int, Products> ProductsList(Int32 catid)
        {
            SortedList<int, Products> lsProducts = new SortedList<int, Products>(catid);
            MySqlConnection conGet = new MySqlConnection(MySQLRunner.ConnectionString);
            MySqlDataReader drGet = null;
            string sSQL = "";
            Products oProduct;

            sSQL = "SELECT id FROM products WHERE category = '" + catid + "'";

            if (MySQLRunner.ExecuteQuery(sSQL, conGet, ref drGet) == true)
            {

                while (drGet.Read())
                {
                    oProduct = new Products(drGet.GetInt32(drGet.GetOrdinal("id")));
                    lsProducts.Add(oProduct.ID, oProduct);
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
            return lsProducts;
        }
        /*******************
          * Clients Sorted List
          *******************/
        public static SortedList<int, Clients> ClientList()
        {
            SortedList<int, Clients> lsClients = new SortedList<int, Clients>();
            MySqlConnection conGet = new MySqlConnection(MySQLRunner.ConnectionString);
            MySqlDataReader drGet = null;
            string sSQL = "";
            Clients oClient;

            sSQL = "SELECT userid FROM clients";

            if (MySQLRunner.ExecuteQuery(sSQL, conGet, ref drGet) == true)
            {

                while (drGet.Read())
                {
                    oClient = new Clients(drGet.GetInt32(drGet.GetOrdinal("userid")));
                    lsClients.Add(oClient.ID, oClient);
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
            return lsClients;
        }
    }
}
