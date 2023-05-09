import os
import core.inserters.CoreInserter as CoreInserter
import core.inserters.AudioInserter as AudioInserter
import core.processors.AudioProcessor as AudioProcessor
import core.processors.AudioPostProcessor as AudioPostProcessor
import core.inserters.AccelerationInserter as AccelerationInserter
import core.inserters.QuestionnaireInserter as QuestionnaireInserter

### Uncomment this to process raw audio into CSVs. UNTESTED IN NEWEST VERSION!
# AudioProcessor()
# AudioPostProcessor.PostprocessAudio()

os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'django_settings.development_settings')

# Inserts the timestamps (timings), temperature and pollution for all lines.
CoreInserter.InsertAll()

# Inserts the audio data for all lines
for filename in os.listdir("data/audio/"):
    AudioInserter.Insert(filename)

# Inserts the acceleration data for all lines
for filename in os.listdir("data/acceleration/"):
    AccelerationInserter.Insert(filename)

# Inserts the questionnaire data for all lines
for filename in os.listdir("data/questionnaire/"):
    QuestionnaireInserter.Insert(filename)

print("Data Insert Complete")