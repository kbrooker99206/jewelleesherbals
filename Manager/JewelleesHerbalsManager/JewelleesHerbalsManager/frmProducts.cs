using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using MySql.Data.MySqlClient;
using MysqlLib.Command;
using JewelleesHerbalsManager.MySQL;
using System.Threading;

namespace JewelleesHerbalsManager
{
    public partial class frmProducts : Form
    {

        Dictionary<int, ProductCats> cats;
        Dictionary<int, Products> products;
        public frmProducts()
        {
            bool notExisting = false;
            Mutex mutex = new Mutex(true, "ProductsManager", out notExisting);
            if (notExisting)
            {
                InitializeComponent();
            }
            else
            {
                MessageBox.Show("Another instance is already running");
                this.Close();
            }

            GC.KeepAlive(mutex);
            cats = new Dictionary<int, ProductCats>();
            products = new Dictionary<int, Products>();
        }
        public void ProductCatsList()
        {
            lsvProductCats.Items.Clear();
            cats.Clear();
            AsyncMysqlQuery query = new AsyncMysqlQuery("CALL sp_GetProductCats();");

            query.SetHandler(delegate(MySqlDataReader reader)
            {
                if (query.Error == null)
                {
                    while (reader.Read())
                    {
                        ProductCats cat = new ProductCats(reader);

                        ListViewItem lsvItem = new ListViewItem(cat.Name);                      
                        lsvItem.Tag = cat.Id.ToString();

                        cats.Add(cat.Id, cat);
                        lsvProductCats.Invoke(new DelegateVoid(delegate()
                        {
                            lsvProductCats.Items.Add(lsvItem);
                        }));
                    }
                }
                else
                {
                    MessageBox.Show("something went wrong");
                }
            });
            Database.Herbals.ExecuteSync(query);
        }
        public void ProductsList(Int32 catid)
        {
            lsvProducts.Items.Clear();
            products.Clear();
            MySqlCommand command = new MySqlCommand("sp_GetProducts");

            command.Parameters.Add(new MySqlParameter("pcategory", catid));           
            command.CommandType = System.Data.CommandType.StoredProcedure;

            AsyncMysqlQuery query = new AsyncMysqlQuery(command);

            query.SetHandler(delegate(MySqlDataReader reader)
            {
                if (query.Error == null)
                {
                    while (reader.Read())
                    {
                        Products product = new Products(reader);

                        ListViewItem lsvItem = new ListViewItem(product.Name);
                        lsvItem.Tag = product.Id.ToString();

                        products.Add(product.Id, product);
                        lsvProducts.Invoke(new DelegateVoid(delegate()
                        {
                            lsvProducts.Items.Add(lsvItem);
                        }));
                    }
                }
                else
                {
                    MessageBox.Show("something went wrong");
                }
            });
            Database.Herbals.ExecuteSync(query);
            
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
            Database.Startup();
            this.FormClosed += new FormClosedEventHandler(frmProducts_FormClosed); 
            ProductCatsList();
        }

        private void lsvProductCats_MouseDoubleClick(object sender, MouseEventArgs e)
        {
            if (lsvProductCats.SelectedItems.Count <= 0)
            {
                return;
            }

            int clickedCatId = int.Parse(lsvProductCats.SelectedItems[0].Tag.ToString());

            if (cats.ContainsKey(clickedCatId))
            {
                ProductCats clickedCat = cats[clickedCatId];
                txtName.Text = clickedCat.Name;
                txtDescription.Text = clickedCat.Description;
                ProductsList(clickedCatId);
            }
            else
            {
                MessageBox.Show("Dunno that account", "O_o");
            }
        }

        private void btnUpdate_Click(object sender, EventArgs e)
        {
            int clickedCatId = int.Parse(lsvProductCats.SelectedItems[0].Tag.ToString());

            if (cats.ContainsKey(clickedCatId))
            {
                MySqlCommand command = new MySqlCommand("sp_ProductCatUpdate");

                command.Parameters.Add(new MySqlParameter("pid", clickedCatId));
                command.Parameters.Add(new MySqlParameter("pname", txtName.Text));
                command.Parameters.Add(new MySqlParameter("pdescription", txtDescription.Text));

                command.CommandType = System.Data.CommandType.StoredProcedure;

                AsyncMysqlQuery query = new AsyncMysqlQuery(command);

                query.SetHandler(delegate(MySqlDataReader reader)
                {
                    if (query.Error == null)
                    {
                        MessageBox.Show("Update Successfull");
                        ClearProductCats();
                        ProductCatsList();
                    }
                    else
                    {
                        MessageBox.Show(query.Error.Message);
                    }
                });

                Database.Herbals.ExecuteAsync(query);
            }
        }

        private void btnAdd_Click(object sender, EventArgs e)
        {            
                MySqlCommand command = new MySqlCommand("sp_ProductCatAdd");

                command.Parameters.Add(new MySqlParameter("pname", txtName.Text));
                command.Parameters.Add(new MySqlParameter("pdescription", txtDescription.Text));

                command.CommandType = System.Data.CommandType.StoredProcedure;

                AsyncMysqlQuery query = new AsyncMysqlQuery(command);

                query.SetHandler(delegate(MySqlDataReader reader)
                {
                    if (query.Error == null)
                    {
                        MessageBox.Show("Creation Successfull");
                        ClearProductCats();
                        ProductCatsList();
                    }
                    else
                    {
                        MessageBox.Show(query.Error.Message);
                    }
                });

                Database.Herbals.ExecuteAsync(query);            
        }

        private void lsvProducts_MouseDoubleClick(object sender, MouseEventArgs e)
        {
            if (lsvProducts.SelectedItems.Count <= 0)
            {
                return;
            }

            int clickedProductId = int.Parse(lsvProducts.SelectedItems[0].Tag.ToString());

            if (products.ContainsKey(clickedProductId))
            {
                Products clickedProduct = products[clickedProductId];
                txtProductName.Text = clickedProduct.Name;
                txtProductDescription.Text = clickedProduct.Description;
                txtProductCategory.Text = clickedProduct.Category;
                txtProductImage.Text = clickedProduct.Image;
                txtProductPrice.Text = clickedProduct.Price;
                txtProductWeight.Text = clickedProduct.Weight;
                txtPaypalType.Text = clickedProduct.PaypalType;
                txtPaypalWeight.Text = clickedProduct.PaypalWeight;
                txtPaypalPrice.Text = clickedProduct.PaypalPrice;
            }
            else
            {
                MessageBox.Show("Dunno that account", "O_o");
            } 
        }

        private void btnProductUpdate_Click(object sender, EventArgs e)
        {
            int clickedProductId = int.Parse(lsvProducts.SelectedItems[0].Tag.ToString());
            int clickedCatId = int.Parse(lsvProductCats.SelectedItems[0].Tag.ToString());
            if (products.ContainsKey(clickedProductId))
            {
                MySqlCommand command = new MySqlCommand("sp_ProductUpdate");

                command.Parameters.Add(new MySqlParameter("pid", clickedProductId));
                command.Parameters.Add(new MySqlParameter("pcategory", txtProductCategory.Text));
                command.Parameters.Add(new MySqlParameter("pname", txtProductName.Text));
                command.Parameters.Add(new MySqlParameter("pdescription", txtProductDescription.Text));
                command.Parameters.Add(new MySqlParameter("pprice", txtProductPrice.Text));
                command.Parameters.Add(new MySqlParameter("pimage", txtProductImage.Text));
                command.Parameters.Add(new MySqlParameter("pweight", txtProductWeight.Text));
                command.Parameters.Add(new MySqlParameter("ppaypaltype", txtPaypalType.Text));
                command.Parameters.Add(new MySqlParameter("ppaypalprice", txtPaypalPrice.Text));
                command.Parameters.Add(new MySqlParameter("ppaypalweight", txtPaypalWeight.Text));
                

                command.CommandType = System.Data.CommandType.StoredProcedure;

                AsyncMysqlQuery query = new AsyncMysqlQuery(command);

                query.SetHandler(delegate(MySqlDataReader reader)
                {
                    if (query.Error == null)
                    {
                        MessageBox.Show("Update Successfull");
                        ClearProduct();
                        ProductsList(clickedCatId);
                    }
                    else
                    {
                        MessageBox.Show(query.Error.Message);
                    }
                });

                Database.Herbals.ExecuteAsync(query);
            }
        }

        private void btnProductAdd_Click(object sender, EventArgs e)
        {
            
        }

        private void deleteCategoryToolStripMenuItem_Click(object sender, EventArgs e)
        {
            int clickedCatId = int.Parse(lsvProductCats.SelectedItems[0].Tag.ToString());

            if (cats.ContainsKey(clickedCatId))
            {
                MySqlCommand command = new MySqlCommand("sp_ProductCatDelete");

                command.Parameters.Add(new MySqlParameter("pid", clickedCatId));
                
                command.CommandType = System.Data.CommandType.StoredProcedure;

                AsyncMysqlQuery query = new AsyncMysqlQuery(command);

                query.SetHandler(delegate(MySqlDataReader reader)
                {
                    if (query.Error == null)
                    {
                        MessageBox.Show("Delete Successfull");
                        ClearProductCats();
                        ProductCatsList();
                    }
                    else
                    {
                        MessageBox.Show(query.Error.Message);
                    }
                });

                Database.Herbals.ExecuteAsync(query);
            }
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

        private void frmProducts_FormClosed(object sender, FormClosedEventArgs e)
        {
            Database.Shutdown();
        }
    }
}
