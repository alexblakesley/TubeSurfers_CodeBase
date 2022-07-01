import os
import core.inserters.CoreInserter as CoreInserter
import core.inserters.AudioInserter as AudioInserter
import core.processors.AudioProcessor as AudioProcessor
import os

os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'django_settings.development_settings')
# CoreInserter.InsertAll();

# for filename in os.listdir("data/audio/"):
#     AudioInserter.Insert(filename)

AudioProcessor.ProcessAudio()



print("Data Insert Complete")