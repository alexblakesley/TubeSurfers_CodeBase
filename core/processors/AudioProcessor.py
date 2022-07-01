import os
import numpy as np
<<<<<<< Updated upstream
from acoustics import Signal

=======
import pandas as pd
from acoustics import Signal
from core.utils.TimestampConverter import ConvertDateTimeToTimestamp
>>>>>>> Stashed changes


def ProcessAudio():
    ### Variables to be adjusted ###
    fileDirectory = "data/audioraw/"
    micGain = 34
    t = 44100000
    ### END ###

<<<<<<< Updated upstream
for filename in os.listdir(fileDirectory):
    # open wave file
    s = Signal.from_wav(os.path.join(fileDirectory, filename))
=======
    with open(os.path.join(fileDirectory, "times.txt")) as f:
        end_time = f.read().splitlines()
>>>>>>> Stashed changes


    for n, filename in enumerate(os.listdir(fileDirectory)):
        # open wave file
        if (os.path.splitext(filename)[1] != ".wav"):
            continue
        s = Signal.from_wav(os.path.join(fileDirectory, filename))

        nSamples = s.samples
        framerate = s.fs
        nChannels = s.channels

        # if there are more than 100m samples, split it up!
        split_signal = []
        for i in range(0, len(s[0]), t):
            split_signal_temp = [s[k][i:(i + t)] for k in range(len(s))]
            split_signal.append(split_signal_temp)
        for i, signal in enumerate(split_signal):
            # print(signal)
            print(len(signal[0]))
            SPL(signal, micGain, end_time, nSamples, framerate, nChannels, filename, i, n)

        print(filename + " - audio preprocessed.")



def SPL(s, micGain, end_time, nSamples, framerate, nChannels, filename, i, n):
    # adjust mic gain
    s.gain(micGain)

    # A-weigh and get sound pressure levels
    spl_a = s.weigh('A').levels()

    # mean over all channels
    spl_mean = np.power(10,0.1*spl_a[1][0])
<<<<<<< Updated upstream
    for i in range(nChannels):
        spl_mean = meanTemp + np.power(10,0.1*spl_a[1][i])
=======
    for i in range(1, nChannels):
        spl_mean = spl_mean + np.power(10,0.1*spl_a[1][i])
>>>>>>> Stashed changes
    spl_mean = 10*np.log10(1/nChannels*spl_mean)

    # downsample fro 8Hz to 2Hz
    spl = [spl_a[0], spl_mean]
    spl8 = [spl[i][0:(len(spl[0])-len(spl[0])%4)] for i in range(len(spl))]
    splarr = np.array(spl8);
    spl2 = [np.mean(splarr[i].reshape(-1, 4), 1) for i in range(len(splarr))]

    # adjust time stamps
    start_time = int(ConvertDateTimeToTimestamp(end_time[n])) - nSamples/framerate
    print(start_time)
    spl2[0] = spl2[0]+start_time

    # transpose array
    spl2 = np.transpose(spl2)

    # define headers
    pd_spl = pd.DataFrame(spl2,columns=['Timestamps','spl'])

    # write as csv
    pd_spl.to_csv("data/audio/" + filename + str(i) + ".csv", index=False, header=True, sep=',')

    





