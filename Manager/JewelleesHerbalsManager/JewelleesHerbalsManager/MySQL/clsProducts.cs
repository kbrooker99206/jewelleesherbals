using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using MySql.Data.MySqlClient;
using MysqlLib.Command;

namespace JewelleesHerbalsManager.MySQL
{
    class Products
    {
        public int Id
        {
            get;
            private set;
        }

        public String Category
        {
            get;
            private set;
        }

        public String Name
        {
            get;
            private set;
        }
        public String Description
        {
            get;
            private set;
        }
        public String Price
        {
            get;
            private set;
        }
        public String Image
        {
            get;
            private set;
        }
        public String Weight
        {
            get;
            private set;
        }
        public String PaypalType
        {
            get;
            private set;
        }
        public String PaypalPrice
        {
            get;
            private set;
        }
        public String PaypalWeight
        {
            get;
            private set;
        }
        public Products(MySqlDataReader reader)
        {
            this.Id = reader.GetInt32("id");
            this.Category = reader.GetString("category");
            this.Name = reader.GetString("product_name");
            this.Description = reader.GetString("product_description");
            this.Price = reader.GetString("product_price");
            this.Image = reader.GetString("product_image");
            this.Weight = reader.GetString("product_weight");
            this.PaypalType = reader.GetString("paypaltype");
            this.PaypalPrice = reader.GetString("paypalprice");
            this.PaypalWeight = reader.GetString("paypalweight");
        }
    }
}