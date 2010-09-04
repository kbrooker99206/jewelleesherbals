using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using MysqlLib;
namespace JewelleesHerbalsManager
{
    class Database
    {
        private static MysqlEngine mHerbalsDb;

        public static MysqlEngine Herbals
        {
            get
            {
                return mHerbalsDb;
            }
        }

        public static void Startup()
        {
            mHerbalsDb = new MysqlEngine("Address=192.168.2.3;Username=root;Password=cdered;database=jewelleesherbals;");
            mHerbalsDb.AddConnections(2);


        }

        public static void Shutdown()
        {
            mHerbalsDb.Shutdown(false);
        }
    }
}
