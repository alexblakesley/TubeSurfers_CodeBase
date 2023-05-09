import os
import numpy as np
import pandas as pd
from pydub import AudioSegment
from pydub.utils import make_chunks
from acoustics import Signal
from core.utils.TimestampConverter import ConvertDateTimeToTimestamp

class AudioProcessor():

    fileDirectory = "data/audioraw/"
    micGain = 34
    timeForSplit = 3000 # file size in seconds, if this is exceeded, file will be split into chunks

    def __init__(self):
        # self = type('test', (object,), {})()


        with open(os.path.join(self.fileDirectory, "times.txt")) as f:
            self.end_time = f.read().splitlines()

        self.ReadAudio()

    def ReadAudio(self):
        for n, self.filename in enumerate(os.listdir(self.fileDirectory)):
            self.notAWavFile = False
            # open wave file
            self.OpenWavFile()
            if (not self.notAWavFile):
                self.start_time = int(ConvertDateTimeToTimestamp(self.end_time[n])) - self.nSamples/self.framerate
                self.CheckLength()
                if (not self.audioSplit):
                    self.SPL()

            print(self.filename + " - audio preprocessed.")


    def OpenWavFile(self):
        if (os.path.splitext(self.filename)[1] != ".wav"):
            self.notAWavFile = True
        else:
            self.notAWavFile = False

            self.s = Signal.from_wav(os.path.join(self.fileDirectory, self.filename))

            self.nSamples = self.s.samples
            self.framerate = self.s.fs
            self.nChannels = self.s.channels


    def CheckLength(self):
        if (self.nSamples/self.framerate > self.timeForSplit):
            self.audioSplit = True
            audio = AudioSegment.from_wav(os.path.join(self.fileDirectory, self.filename))
            oldFilename = os.path.splitext(self.filename)[0]


            chunk_length_ms = self.timeForSplit * 1000 # pydub calculates in millisec
            chunks = make_chunks(audio, chunk_length_ms) #Make chunks of timeForSplit sec

            #Export all of the individual chunks as wav files

            for i, chunk in enumerate(chunks):
                newFilename = oldFilename+"{0}.wav".format(i)
                # chunk_name = "chunk{0}.wav".format(i)
                chunk.export(os.path.join(self.fileDirectory, newFilename), format="wav")
                self.filename = newFilename
                print(newFilename)
                self.OpenWavFile()
                self.SPL()
                self.start_time += self.timeForSplit
        else:
            self.audioSplit = False


    def SPL(self):
        # adjust mic gain
        self.s.gain(self.micGain)

        # A-weigh and get sound pressure levels
        spl_a = self.s.weigh('A').levels()

        # mean over all channels
        spl_mean = np.power(10,0.1*spl_a[1][0])
        for i in range(1, self.nChannels):
            spl_mean = spl_mean + np.power(10,0.1*spl_a[1][i])
        spl_mean = 10*np.log10(1/self.nChannels*spl_mean)

        # downsample fro 8Hz to 2Hz
        spl = [spl_a[0], spl_mean]
        spl8 = [spl[i][0:(len(spl[0])-len(spl[0])%4)] for i in range(len(spl))]
        splarr = np.array(spl8)
        spl2 = [np.mean(splarr[i].reshape(-1, 4), 1) for i in range(len(splarr))]

        # adjust time stamps
        # start_time = int(ConvertDateTimeToTimestamp(self.end_time[n])) - self.nSamples/self.framerate
        spl2[0] = spl2[0]+self.start_time

        # transpose array
        spl2 = np.transpose(spl2)

        # define headers
        pd_spl = pd.DataFrame(spl2,columns=['Timestamps','spl'])

        # write as csv
        pd_spl.to_csv("data/audio/" + self.filename + ".csv", index=False, header=True, sep=',')

            





        





