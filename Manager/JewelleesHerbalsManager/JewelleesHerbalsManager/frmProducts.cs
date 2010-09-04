using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using MySql.Data.MySqlClient;
using JewelleesMySQL;

namespace JewelleesHerbalsManager
{
    public partial class frmProducts : Form
    {

       private bool flgProductsLoaded = false;

        public frmProducts()
        {
            InitializeComponent();
        }
        public void ProductCatsList()
        {
            
        }
        public void ProductsList(Int32 catid)
        {
            
            
        }
        public void ClearProductCats()
        {
            txtName.Text = "";
            txtDescription.Text = "";
        }
        public void ClearProduct()
        {
            txtProductName.Text = "";
            txtProductDescription.Text = "";
            txtProductCategory.Text = "";
            txtProductPrice.Text = "";
            txtProductImage.Text = "";
            txtProductWeight.Text = "";
            txtPaypalType.Text = "";
            txtPaypalPrice.Text = "";
            txtPaypalWeight.Text = "";
        }
        private void frmProducts_Load(object sender, EventArgs e)
        {
            ProductCatsList();
        }

        private void lsvProductCats_MouseDoubleClick(object sender, MouseEventArgs e)
        {

        }

        private void btnUpdate_Click(object sender, EventArgs e)
        {
           
        }

        private void btnAdd_Click(object sender, EventArgs e)
        {
            
        }

        private void lsvProducts_MouseDoubleClick(object sender, MouseEventArgs e)
        {
            
        }

        private void btnProductUpdate_Click(object sender, EventArgs e)
        {
           
        }

        private void btnProductAdd_Click(object sender, EventArgs e)
        {
            
        }

        private void deleteCategoryToolStripMenuItem_Click(object sender, EventArgs e)
        {
            
        }

        private void deleteProductToolStripMenuItem_Click(object sender, EventArgs e)
        {
            
        }

        private void button1_Click(object sender, EventArgs e)
        {
            
        }

        private void btnReset_Click(object sender, EventArgs e)
        {
            
        }
    }
}
