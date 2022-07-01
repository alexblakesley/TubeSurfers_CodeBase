import os
import core.inserters.CoreInserter as CoreInserter

os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'django_settings.development_settings')
CoreInserter.InsertAll();

print("Data Insert Complete")